<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\BookGetRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    /**
     * @return Collection<int, Book>
     */
    public function getWithRequest(BookGetRequest $getRequest): Collection;
}
