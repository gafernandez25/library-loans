<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Data;

class UserGetRequest extends Data
{
    public function __construct(
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $email = null,
    ) {
    }
}
