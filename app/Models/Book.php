<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property string $title
 * @property string $isbn
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property \DateTime $deleted_at
 */
class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'isbn',
    ];

    protected $dates = ['deleted_at'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->as('loans')
            ->withPivot(['created_at']);
    }
}
