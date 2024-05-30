<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface LoanRepositoryInterface
{
    public function getUserLoans(): Collection;

    public function getBookLoans(): Collection;
}
