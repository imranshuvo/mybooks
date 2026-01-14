<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\ReadingProgress;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('status', 'available')->count();
        $borrowedBooks = Book::where('status', 'borrowed')->count();
        $booksAddedByUser = Book::where('added_by', auth()->id())->count();
        
        $recentBooks = Book::with('addedBy')->latest()->take(6)->get();
        $currentlyBorrowed = BookLoan::with(['book', 'recordedBy'])
            ->where('status', 'borrowed')
            ->latest()
            ->take(5)
            ->get();
        
        $userReadingProgress = ReadingProgress::with('book')
            ->where('user_id', auth()->id())
            ->where('status', 'reading')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'availableBooks',
            'borrowedBooks',
            'booksAddedByUser',
            'recentBooks',
            'currentlyBorrowed',
            'userReadingProgress'
        ));
    }
}
