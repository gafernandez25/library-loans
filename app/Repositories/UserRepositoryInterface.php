<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\ValueObjects\SearchUser;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @return Collection<int, User>
     */
    public function search(SearchUser $searchUser): Collection;
}
