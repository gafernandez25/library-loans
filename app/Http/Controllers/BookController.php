<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataObjects\Book;
use App\Http\Requests\BookGetRequest;
use App\Repositories\BookRepositoryInterface;
use App\ValueObjects\SearchBook;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct(private readonly BookRepositoryInterface $bookRepository)
    {
    }

    #[OA\Get(
        path: self::OA_DOC_API_VERSION_PATH . '/book',
        summary: 'Returns a list of books. Search options available.',
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                description: 'Search fields',
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string',
                        example: 'Mastering Laravel'
                    ),
                    new OA\Property(
                        property: 'isbn',
                        description: '13 digits',
                        type: 'string',
                        example: '978-3-16-148410-0',
                    ),
                ],
                type: 'object',
            ),
        ),
        tags: ['Books'],
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
                                        example: 1,
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
    public function list(BookGetRequest $request): JsonResponse
    {
        $books = $this->bookRepository->search(
            new SearchBook(
                title: $request->title,
                isbn: $request->isbn,
            )
        );

        return response()->json([
            'books' => Book::collect($books)
        ]);
    }
}
