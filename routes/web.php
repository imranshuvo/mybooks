<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookNoteController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\ReadingProgressController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

// Public welcome page with books
Route::get('/', [BookController::class, 'welcome'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Books
    Route::resource('books', BookController::class);
    
    // Book Notes
    Route::post('/books/{book}/notes', [BookNoteController::class, 'store'])->name('books.notes.store');
    Route::delete('/notes/{note}', [BookNoteController::class, 'destroy'])->name('notes.destroy');
    
    // Book Loans
    Route::post('/books/{book}/loans', [BookLoanController::class, 'store'])->name('books.loans.store');
    Route::patch('/loans/{loan}', [BookLoanController::class, 'update'])->name('loans.update');
    Route::delete('/loans/{loan}', [BookLoanController::class, 'destroy'])->name('loans.destroy');
    
    // Reading Progress
    Route::post('/books/{book}/progress', [ReadingProgressController::class, 'store'])->name('books.progress.store');
    
    // Statistics
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::get('/statistics/export-pdf', [StatisticsController::class, 'exportPdf'])->name('statistics.export-pdf');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
