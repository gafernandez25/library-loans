<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\BookGetRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentBookRepository implements BookRepositoryInterface
{
    /**
     * @return Collection<int,Book>
     */
    public function getWithRequest(BookGetRequest $getRequest): Collection
    {
        return Book::query()
            ->select('books.id', 'books.title', 'books.isbn')
            ->when($getRequest->title, function (Builder $query) use ($getRequest) {
                return $query->where('books.title', 'LIKE', '%' . $getRequest->title . '%');
            })
            ->when($getRequest->isbn, function (Builder $query) use ($getRequest) {
                return $query->where('books.isbn', 'LIKE', '%' . $getRequest->isbn . '%');
            })
            ->get();
    }
}
