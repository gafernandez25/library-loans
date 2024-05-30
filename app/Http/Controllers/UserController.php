<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataObjects\User;
use App\Http\Requests\UserGetRequest;
use App\Repositories\EloquentUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function __construct(private readonly EloquentUserRepository $userRepository)
    {
    }

    public function list(UserGetRequest $request): JsonResponse
    {
        /** @var Collection<int, User> $users */
        $users = User::collect($this->userRepository->getWithRequest($request));

        return response()->json($users);
    }
}
