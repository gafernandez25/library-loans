<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataObjects\Book;
use App\Http\Requests\BookGetRequest;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function __construct(private readonly BookRepositoryInterface $bookRepository)
    {
    }

    public function list(BookGetRequest $request): JsonResponse
    {
        /** @var Book $books */
        $books = Book::collect($this->bookRepository->getWithRequest($request));

        return response()->json($books);
    }
}
