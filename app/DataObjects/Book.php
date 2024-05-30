<?php

declare(strict_types=1);

namespace App\DataObjects;

use Spatie\LaravelData\Data;

class Book extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $isbn,
    ) {
    }
}
