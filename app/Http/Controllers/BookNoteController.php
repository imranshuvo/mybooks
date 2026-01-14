<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookNote;
use Illuminate\Http\Request;

class BookNoteController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        $book->notes()->create([
            'user_id' => auth()->id(),
            'note' => $validated['note'],
        ]);

        return redirect()->back()->with('success', 'Note added successfully!');
    }

    public function destroy(BookNote $note)
    {
        // Only the note author can delete their note
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully!');
    }
}
