<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Data;

class UserGetRequest extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $surname,
        public ?string $email,
    ) {
    }
}
