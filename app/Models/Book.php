<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'language',
        'isbn',
        'publication_year',
        'publisher',
        'total_pages',
        'category',
        'status',
        'cover_image',
        'description',
        'added_by',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'total_pages' => 'integer',
    ];

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(BookNote::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }

    public function readingProgress(): HasMany
    {
        return $this->hasMany(ReadingProgress::class);
    }

    public function currentLoan()
    {
        return $this->hasOne(BookLoan::class)->where('status', 'borrowed')->latest();
    }
}
