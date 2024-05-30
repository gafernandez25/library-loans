<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Data;

class BookGetRequest extends Data
{
    public function __construct(
        public ?string $title = null,
        public ?string $isbn = null,
    ) {
    }
}
