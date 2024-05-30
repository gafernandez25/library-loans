<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\ValueObjects\SearchUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{

    /**
     * @return Collection<int,User>
     */
    public function search(SearchUser $searchUser): Collection
    {
        return User::query()
            ->select('users.id', 'users.name', 'users.surname', 'users.email')
            ->when($searchUser->name, function (Builder $query) use ($searchUser) {
                return $query->where('users.name', 'LIKE', '%' . $searchUser->name . '%');
            })
            ->when($searchUser->surname, function (Builder $query) use ($searchUser) {
                return $query->where('users.surname', 'LIKE', '%' . $searchUser->surname . '%');
            })
            ->when($searchUser->email, function (Builder $query) use ($searchUser) {
                return $query->where('users.email', 'LIKE', '%' . $searchUser->email . '%');
            })
            ->get();
    }
}
