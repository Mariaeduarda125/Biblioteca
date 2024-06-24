<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Auth::user()->books;
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'cover' => 'nullable|image|max:2048', // Validação para imagem
        ]);
    
        $book = new Book($request->except('cover'));
        $book->user_id = Auth::id();
    
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public'); // Salva na pasta public/covers
            $book->cover = basename($path); // Armazena apenas o nome do arquivo no banco de dados
        }
        
    
        $book->save();
    
        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso!');
    }
    

    public function show(Book $book)
    {
        if (Gate::denies('view', $book)) {
            abort(403); // Retorna uma resposta 403 Forbidden se a autorização for negada
        }

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        if (Gate::denies('update', $book)) {
            abort(403); // Retorna uma resposta 403 Forbidden se a autorização for negada
        }

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        if (Gate::denies('update', $book)) {
            abort(403); // Retorna uma resposta 403 Forbidden se a autorização for negada
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'cover' => 'nullable|image|max:2048', // Validação para imagem
        ]);

        $book->fill($request->except('cover'));

        if ($request->hasFile('cover')) {
            // Deletar a imagem antiga se existir
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Book $book)
    {
        if (Gate::denies('delete', $book)) {
            abort(403); // Retorna uma resposta 403 Forbidden se a autorização for negada
        }

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}
