<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface LoanRepositoryInterface
{
    /**
     * @return Collection<int, User>
     */
    public function getUserLoans(): Collection;

    /**
     * @return Collection<int, Book>
     */
    public function getBookLoans(): Collection;
}
