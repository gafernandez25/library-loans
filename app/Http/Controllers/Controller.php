<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: '1.0.0', title: 'Library loans API'),
    OA\Schema(
        schema: 'book_properties',
        properties: [
            new OA\Property(
                property: 'id',
                type: 'integer',
                example: 1,
            ),
            new OA\Property(
                property: 'title',
                type: 'string',
                example: 'Mastering Laravel',
            ),
            new OA\Property(
                property: 'isbn',
                type: 'string',
                example: '978-3-16-148410-0',
            ),
        ],
    )
]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected const OA_DOC_API_VERSION_PATH = '/api/v1';
}
