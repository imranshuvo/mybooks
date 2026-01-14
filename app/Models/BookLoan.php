<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookLoan extends Model
{
    protected $fillable = [
        'book_id',
        'borrower_name',
        'borrower_contact',
        'borrowed_date',
        'expected_return_date',
        'returned_date',
        'status',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'borrowed_date' => 'date',
        'expected_return_date' => 'date',
        'returned_date' => 'date',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
