@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Livro</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="subtitle">Subtítulo:</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $book->subtitle }}">
        </div>
        <div class="form-group">
            <label for="author">Autor:</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
        </div>
        <div class="form-group">
            <label for="publisher">Editora:</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher }}">
        </div>
        <div class="form-group">
            <label for="edition">Edição:</label>
            <input type="text" class="form-control" id="edition" name="edition" value="{{ $book->edition }}">
        </div>
        <div class="form-group">
            <label for="year">Ano:</label>
            <input type="text" class="form-control" id="year" name="year" value="{{ $book->year }}">
        </div>
        <div class="form-group">
            <label for="cover">Capa do Livro:</label>
            <input type="file" class="form-control" id="cover" name="cover">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
