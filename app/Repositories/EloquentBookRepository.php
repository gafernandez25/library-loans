<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\ValueObjects\SearchBook;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentBookRepository implements BookRepositoryInterface
{
    /**
     * @return Collection<int,Book>
     */
    public function search(SearchBook $searchBook): Collection
    {
        return Book::query()
            ->select('books.id', 'books.title', 'books.isbn')
            ->when($searchBook->title, function (Builder $query) use ($searchBook) {
                return $query->where('books.title', 'LIKE', '%' . $searchBook->title . '%');
            })
            ->when($searchBook->isbn, function (Builder $query) use ($searchBook) {
                return $query->where('books.isbn', 'LIKE', '%' . $searchBook->isbn . '%');
            })
            ->get();
    }
}
