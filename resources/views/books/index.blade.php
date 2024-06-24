@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Meus Livros</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Adicionar Livro</a>
    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Subtítulo</th>
                    <th>Editora</th>
                    <th>Edição</th>
                    <th>Ano</th>
                    <th>Capa</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->subtitle }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->edition }}</td>
                    <td>{{ $book->year }}</td>
                    <td>
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Capa do Livro" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
