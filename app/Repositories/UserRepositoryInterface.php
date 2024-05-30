<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\UserGetRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @return Collection<int, User>
     */
    public function getWithRequest(UserGetRequest $getRequest): Collection;
}
