<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataObjects\User;
use App\Http\Requests\UserGetRequest;
use App\Repositories\EloquentUserRepository;
use App\ValueObjects\SearchUser;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private readonly EloquentUserRepository $userRepository)
    {
    }

    public function list(UserGetRequest $request): JsonResponse
    {
        $users = $this->userRepository->search(
            new SearchUser(
                name: $request->name,
                surname: $request->surname,
                email: $request->email,
            )
        );


        return response()->json([
            'users' => User::collect($users)
        ]);
    }
}
