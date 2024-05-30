<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EloquentLoanRepository implements LoanRepositoryInterface
{

    public function getUserLoans(): Collection
    {
        return User::query()
            ->select('users.id', 'users.name', 'users.surname', 'users.email')
            ->with([
                'books' => function (BelongsToMany $query) {
                    $query->select('title', 'isbn')->withPivot('created_at');
                },
            ])
            ->get();
    }

    public function getBookLoans(): Collection
    {
        return Book::query()
            ->select('books.id', 'books.title', 'books.isbn')
            ->with([
                'users' => function (BelongsToMany $query) {
                    $query->select('name', 'surname', 'email')->withPivot('created_at');
                },
            ])
            ->get();
    }
}
