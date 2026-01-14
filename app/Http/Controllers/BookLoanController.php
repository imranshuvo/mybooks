<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrower_contact' => 'nullable|string|max:255',
            'borrowed_date' => 'required|date',
            'expected_return_date' => 'nullable|date|after_or_equal:borrowed_date',
            'notes' => 'nullable|string',
        ]);

        $validated['recorded_by'] = auth()->id();
        $validated['book_id'] = $book->id;
        $validated['status'] = 'borrowed';

        BookLoan::create($validated);

        // Update book status
        $book->update(['status' => 'borrowed']);

        return redirect()->back()->with('success', 'Loan recorded successfully!');
    }

    public function update(Request $request, BookLoan $loan)
    {
        $validated = $request->validate([
            'returned_date' => 'required|date',
        ]);

        $loan->update([
            'returned_date' => $validated['returned_date'],
            'status' => 'returned',
        ]);

        // Update book status to available
        $loan->book->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Book returned successfully!');
    }

    public function destroy(BookLoan $loan)
    {
        $loan->delete();
        return redirect()->back()->with('success', 'Loan record deleted successfully!');
    }
}
