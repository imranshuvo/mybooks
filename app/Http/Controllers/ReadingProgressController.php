<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingProgress;
use Illuminate\Http\Request;

class ReadingProgressController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'current_page' => 'required|integer|min:0',
            'status' => 'required|in:not_started,reading,completed',
        ]);

        $progress = ReadingProgress::updateOrCreate(
            [
                'book_id' => $book->id,
                'user_id' => auth()->id(),
            ],
            $validated
        );

        // Set started_at if status is reading and not set
        if ($validated['status'] === 'reading' && !$progress->started_at) {
            $progress->update(['started_at' => now()]);
        }

        // Set completed_at if status is completed
        if ($validated['status'] === 'completed') {
            $progress->update(['completed_at' => now()]);
        }

        return redirect()->back()->with('success', 'Reading progress updated!');
    }
}
