<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\ValueObjects\SearchBook;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    /**
     * @return Collection<int, Book>
     */
    public function search(SearchBook $searchBook): Collection;
}
