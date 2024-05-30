<?php

declare(strict_types=1);

namespace App\DataObjects;

use Spatie\LaravelData\Data;

class User extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $surname,
        public string $email,
    ) {
    }
}
