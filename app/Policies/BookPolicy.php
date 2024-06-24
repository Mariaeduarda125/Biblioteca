<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    public function view(User $user, Book $book)
    {
        return true; // Qualquer usuário pode visualizar um livro
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }
}
