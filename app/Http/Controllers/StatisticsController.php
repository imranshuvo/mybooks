<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\ReadingProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StatisticsController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'available_books' => Book::where('status', 'available')->count(),
            'borrowed_books' => Book::where('status', 'borrowed')->count(),
            'total_users' => User::count(),
            'books_by_language' => Book::selectRaw('language, COUNT(*) as count')
                ->groupBy('language')
                ->orderBy('count', 'desc')
                ->get(),
            'books_by_category' => Book::selectRaw('category, COUNT(*) as count')
                ->whereNotNull('category')
                ->groupBy('category')
                ->orderBy('count', 'desc')
                ->get(),
            'top_contributors' => User::withCount('booksAdded')
                ->having('books_added_count', '>', 0)
                ->orderBy('books_added_count', 'desc')
                ->take(10)
                ->get(),
            'total_loans' => BookLoan::count(),
            'active_loans' => BookLoan::where('status', 'borrowed')->count(),
            'completed_reads' => ReadingProgress::where('status', 'completed')->count(),
        ];

        return view('statistics.index', compact('stats'));
    }

    public function exportPdf()
    {
        $books = Book::with('addedBy')->get();
        
        $pdf = Pdf::loadView('statistics.pdf', compact('books'));
        
        return $pdf->download('library-books-' . now()->format('Y-m-d') . '.pdf');
    }
}
