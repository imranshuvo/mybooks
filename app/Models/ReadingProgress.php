<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingProgress extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'current_page',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'current_page' => 'integer',
        'started_at' => 'date',
        'completed_at' => 'date',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
