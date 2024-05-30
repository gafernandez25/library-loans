<?php

declare(strict_types=1);

namespace App\ValueObjects;

readonly class SearchUser
{
    public function __construct(
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $email = null,
    ) {
    }
}
