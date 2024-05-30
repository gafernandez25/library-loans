<?php

declare(strict_types=1);

namespace App\ValueObjects;

readonly class SearchBook
{
    public function __construct(
        public ?string $title = null,
        public ?string $isbn = null,
    ) {
    }
}
