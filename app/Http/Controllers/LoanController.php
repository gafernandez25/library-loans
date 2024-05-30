<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\LoanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{
    public function __construct(private readonly LoanRepositoryInterface $loanRepository)
    {
    }

    #[OA\Get(
        path: self::OA_DOC_API_VERSION_PATH . '/loan/user',
        summary: 'Returns a list of users with their book loans.',
        tags: ['Loans'],
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
                                        example: 5,
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
                                    new OA\Property(
                                        property: 'books',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    example: 10,
                                                ),
                                                new OA\Property(
                                                    property: 'title',
                                                    type: 'string',
                                                    example: 'Mastering Laravel',
                                                ),
                                                new OA\Property(
                                                    property: 'isbn',
                                                    type: 'string',
                                                    example: '978-3-16-148410-0',
                                                ),
                                                new OA\Property(
                                                    property: 'loans',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'user_id',
                                                            type: 'integer',
                                                            example: 5
                                                        ),
                                                        new OA\Property(
                                                            property: 'book_id',
                                                            type: 'integer',
                                                            example: 10
                                                        ),
                                                        new OA\Property(
                                                            property: 'created_at',
                                                            description: 'Loan date',
                                                            type: 'string',
                                                            example: '2024-05-30T16:41:44.000000Z',
                                                        )
                                                    ],
                                                    type: 'object'
                                                ),
                                            ],
                                        )
                                    )
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
    public function listUsers(): JsonResponse
    {
        $users = $this->loanRepository->getUserLoans();

        return response()->json([
            'loans' => $users
        ]);
    }

    #[OA\Get(
        path: self::OA_DOC_API_VERSION_PATH . '/loan/book',
        summary: 'Returns a list of books with users who asked a loan.',
        tags: ['Loans'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Successful response',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'books',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: 'id',
                                        type: 'integer',
                                        example: 5,
                                    ),
                                    new OA\Property(
                                        property: 'title',
                                        type: 'string',
                                        example: 'Mastering Laravel',
                                    ),
                                    new OA\Property(
                                        property: 'isbn',
                                        type: 'string',
                                        example: '978-3-16-148410-0',
                                    ),
                                    new OA\Property(
                                        property: 'users',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    example: 10,
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
                                                new OA\Property(
                                                    property: 'loans',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'user_id',
                                                            type: 'integer',
                                                            example: 10
                                                        ),
                                                        new OA\Property(
                                                            property: 'book_id',
                                                            type: 'integer',
                                                            example: 5
                                                        ),
                                                        new OA\Property(
                                                            property: 'created_at',
                                                            description: 'Loan date',
                                                            type: 'string',
                                                            example: '2024-05-30T16:41:44.000000Z',
                                                        )
                                                    ],
                                                    type: 'object'
                                                ),
                                            ],
                                        )
                                    )
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
    public function listBooks(): JsonResponse
    {
        $books = $this->loanRepository->getBookLoans();

        return response()->json([
            'loans' => $books
        ]);
    }
}
