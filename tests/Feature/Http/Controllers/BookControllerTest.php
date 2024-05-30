<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_with_no_search_values(): void
    {
        /** @var Book[] $books */
        $books = Book::factory(2)->create();

        $response = $this->getJson(
            self::API_VERSION_PATH . '/book',
        );

        $response->assertStatus(Response::HTTP_OK);

        $expectedResponse['books'] = [];

        foreach ($books as $book) {
            $expectedResponse['books'][] = [
                'id' => $book->id,
                'title' => $book->title,
                'isbn' => $book->isbn,
            ];
        }

        $response->assertJson($expectedResponse);
    }

    public function test_with_search(): void
    {
        /** @var Book $users */
        $book = Book::factory()->create([
            'title' => 'test-title',
            'isbn' => 'test-isbn',
        ]);

        Book::factory(10)->create();

        $response = $this->getJson(
            self::API_VERSION_PATH . '/book',
        );

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'books' => [
                [
                    'title' => 'test-title',
                    'isbn' => 'test-isbn',
                ],
            ]
        ]);
    }
}
