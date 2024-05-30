<?php

declare(strict_types=1);

namespace Feature\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_users(): void
    {
        /** @var Book $book */
        $book = Book::factory()->create();

        /** @var User $user */
        $user = User::factory()
            ->hasAttached($book)
            ->create();

        $response = $this->getJson(self::API_VERSION_PATH . '/loan/user');

        $response->assertStatus(Response::HTTP_OK);

        $responseData = $response->json();

        $this->assertSame($user->id, $responseData['loans'][0]['id']);
        $this->assertSame($user->name, $responseData['loans'][0]['name']);
        $this->assertSame($user->surname, $responseData['loans'][0]['surname']);
        $this->assertSame($user->email, $responseData['loans'][0]['email']);

        $this->assertSame($book->id, $responseData['loans'][0]['books'][0]['id']);
        $this->assertSame($book->title, $responseData['loans'][0]['books'][0]['title']);
        $this->assertSame($book->isbn, $responseData['loans'][0]['books'][0]['isbn']);
    }

    public function test_list_books(): void
    {
        /** @var Book $book */
        $book = Book::factory()->create();

        /** @var User $user */
        $user = User::factory()
            ->hasAttached($book)
            ->create();

        $response = $this->getJson(self::API_VERSION_PATH . '/loan/book');

        $response->assertStatus(Response::HTTP_OK);

        $responseData = $response->json();

        $this->assertSame($book->id, $responseData['loans'][0]['id']);
        $this->assertSame($book->title, $responseData['loans'][0]['title']);
        $this->assertSame($book->isbn, $responseData['loans'][0]['isbn']);

        $this->assertSame($user->id, $responseData['loans'][0]['users'][0]['id']);
        $this->assertSame($user->name, $responseData['loans'][0]['users'][0]['name']);
        $this->assertSame($user->surname, $responseData['loans'][0]['users'][0]['surname']);
        $this->assertSame($user->email, $responseData['loans'][0]['users'][0]['email']);
    }

}
