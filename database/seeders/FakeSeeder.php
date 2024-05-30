<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(50)->create();
        Book::factory(50)->create();

        /** @var User $user */
        foreach ($users as $user) {
            $books = Book::query()->inRandomOrder()->limit(3)->get();
            $user->books()->attach($books);
        }
    }
}
