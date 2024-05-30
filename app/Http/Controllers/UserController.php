<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataObjects\User;
use App\Http\Requests\UserGetRequest;
use App\Repositories\EloquentUserRepository;
use App\ValueObjects\SearchUser;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private readonly EloquentUserRepository $userRepository)
    {
    }

    #[OA\Get(
        path: self::OA_DOC_API_VERSION_PATH . '/user',
        summary: 'Returns a list of users. Search options available.',
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                description: 'Search fields',
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                        example: 'John'
                    ),
                    new OA\Property(
                        property: 'surname',
                        type: 'string',
                        example: 'Doe'
                    ),
                    new OA\Property(
                        property: 'email',
                        type: 'string',
                        example: 'john@doe.com'
                    ),
                ],
                type: 'object',
            ),
        ),
        tags: ['Users'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Successful response',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'users',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: 'id',
                                        type: 'integer',
                                        example: 1,
                                    ),
                                    new OA\Property(
                                        property: 'name',
                                        type: 'string',
                                        example: 'John',
                                    ),
                                    new OA\Property(
                                        property: 'surname',
                                        type: 'string',
                                        example: 'Doe',
                                    ),
                                    new OA\Property(
                                        property: 'email',
                                        type: 'string',
                                        example: 'john@doe.com',
                                    ),
                                ],
                            ),
                        ),
                    ],
                    type: 'object',
                ),
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Internal error',
                content: new OA\JsonContent(
                    type: 'string',
                    example: 'Server error'
                ),
            ),
        ]
    )]
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
