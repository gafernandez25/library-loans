<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataObjects\Book;
use App\Http\Requests\BookGetRequest;
use App\Repositories\BookRepositoryInterface;
use App\ValueObjects\SearchBook;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function __construct(private readonly BookRepositoryInterface $bookRepository)
    {
    }

    public function list(BookGetRequest $request): JsonResponse
    {
        $books = $this->bookRepository->search(
            new SearchBook(
                title: $request->title,
                isbn: $request->isbn,
            )
        );

        return response()->json(['books' => Book::collect($books)]);
    }
}
