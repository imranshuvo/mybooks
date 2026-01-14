<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function welcome(Request $request)
    {
        $query = Book::with('addedBy');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Filter by language
        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by publication year
        if ($request->filled('year')) {
            $query->where('publication_year', $request->year);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $books = $query->latest()->paginate(12);

        // Get unique values for filters
        $languages = Book::distinct()->pluck('language');
        $categories = Book::distinct()->whereNotNull('category')->pluck('category');
        $years = Book::distinct()->whereNotNull('publication_year')->orderBy('publication_year', 'desc')->pluck('publication_year');

        return view('welcome', compact('books', 'languages', 'categories', 'years'));
    }

    public function index(Request $request)
    {
        $query = Book::with('addedBy');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Filter by language
        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by publication year
        if ($request->filled('year')) {
            $query->where('publication_year', $request->year);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $books = $query->latest()->paginate(12);

        // Get unique values for filters
        $languages = Book::distinct()->pluck('language');
        $categories = Book::distinct()->whereNotNull('category')->pluck('category');
        $years = Book::distinct()->whereNotNull('publication_year')->orderBy('publication_year', 'desc')->pluck('publication_year');

        return view('books.index', compact('books', 'languages', 'categories', 'years'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'publisher' => 'nullable|string|max:255',
            'total_pages' => 'nullable|integer|min:1',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:available,borrowed,reading',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['added_by'] = auth()->id();

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        $book->load(['addedBy', 'notes.user', 'loans.recordedBy', 'readingProgress.user']);
        
        // Get current user's reading progress
        $userProgress = $book->readingProgress()->where('user_id', auth()->id())->first();
        
        // Get current loan if any
        $currentLoan = $book->currentLoan;

        return view('books.show', compact('book', 'userProgress', 'currentLoan'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'publisher' => 'nullable|string|max:255',
            'total_pages' => 'nullable|integer|min:1',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:available,borrowed,reading',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        // Delete cover image
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
