<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\UserGetRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{

    /**
     * @return Collection<int,User>
     */
    public function getWithRequest(UserGetRequest $getRequest): Collection
    {
        return User::query()
            ->select('users.id', 'users.name', 'users.surname', 'users.email')
            ->when($getRequest->name, function (Builder $query) use ($getRequest) {
                return $query->where('users.name', 'LIKE', '%' . $getRequest->name . '%');
            })
            ->when($getRequest->surname, function (Builder $query) use ($getRequest) {
                return $query->where('users.surname', 'LIKE', '%' . $getRequest->surname . '%');
            })
            ->when($getRequest->email, function (Builder $query) use ($getRequest) {
                return $query->where('users.email', 'LIKE', '%' . $getRequest->email . '%');
            })
            ->get();
    }
}
