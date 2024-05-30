<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_with_no_search_values(): void
    {
        /** @var User[] $users */
        $users = User::factory(2)->create();

        $response = $this->getJson(
            self::API_VERSION_PATH . '/user',
        );

        $response->assertStatus(Response::HTTP_OK);

        $expectedResponse['users'] = [];

        foreach ($users as $user) {
            $expectedResponse['users'][] = [
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email
            ];
        }

        $response->assertJson($expectedResponse);
    }

    public function test_with_search(): void
    {
        /** @var User $users */
        $user = User::factory()->create([
            'name' => 'test-name',
            'surname' => 'test-surname',
            'email' => 'test-email',
        ]);

        User::factory(10)->create();

        $response = $this->getJson(
            self::API_VERSION_PATH . '/user',
        );

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'users' => [
                [
                    'name' => 'test-name',
                    'surname' => 'test-surname',
                    'email' => 'test-email',
                ],
            ]
        ]);
    }
}
