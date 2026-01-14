<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-violet-600 transition-colors text-sm font-medium mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Library
        </a>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ $book->title }}</h2>
                <p class="text-slate-500 mt-1">by {{ $book->author }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('books.edit', $book) }}" class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all">
                    Edit
                </a>
                <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Are you sure you want to delete this book?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-red-600 bg-white border border-slate-200 rounded-xl hover:bg-red-50 hover:border-red-200 transition-all">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Book Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Book Card -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <!-- Cover -->
                        <div class="flex-shrink-0">
                            @if($book->cover_image)
                                <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-40 h-56 object-cover rounded-xl shadow-lg">
                            @else
                                <div class="w-40 h-56 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1">
                            <div class="flex flex-wrap gap-2 mb-5">
                                <span class="px-3 py-1.5 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">{{ $book->language }}</span>
                                <span class="px-3 py-1.5 text-xs font-semibold rounded-full
                                    {{ $book->status === 'available' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $book->status === 'borrowed' ? 'bg-amber-100 text-amber-700' : '' }}
                                    {{ $book->status === 'reading' ? 'bg-violet-100 text-violet-700' : '' }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                                @if($book->category)
                                    <span class="px-3 py-1.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">{{ $book->category }}</span>
                                @endif
                            </div>

                            <dl class="grid grid-cols-2 gap-4 text-sm">
                                @if($book->isbn)
                                    <div>
                                        <dt class="text-slate-500">ISBN</dt>
                                        <dd class="font-semibold text-slate-900 mt-0.5">{{ $book->isbn }}</dd>
                                    </div>
                                @endif
                                @if($book->publisher)
                                    <div>
                                        <dt class="text-slate-500">Publisher</dt>
                                        <dd class="font-semibold text-slate-900 mt-0.5">{{ $book->publisher }}</dd>
                                    </div>
                                @endif
                                @if($book->publication_year)
                                    <div>
                                        <dt class="text-slate-500">Year</dt>
                                        <dd class="font-semibold text-slate-900 mt-0.5">{{ $book->publication_year }}</dd>
                                    </div>
                                @endif
                                @if($book->total_pages)
                                    <div>
                                        <dt class="text-slate-500">Pages</dt>
                                        <dd class="font-semibold text-slate-900 mt-0.5">{{ $book->total_pages }}</dd>
                                    </div>
                                @endif
                                <div>
                                    <dt class="text-slate-500">Added by</dt>
                                    <dd class="font-semibold text-slate-900 mt-0.5">{{ $book->addedBy->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-slate-500">Added on</dt>
                                    <dd class="font-semibold text-slate-900 mt-0.5">{{ $book->created_at->format('M d, Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($book->description)
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <h4 class="text-sm font-semibold text-slate-900 mb-2">Description</h4>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Collaborative Notes -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-5">Notes</h3>
                    
                    <form method="POST" action="{{ route('books.notes.store', $book) }}" class="mb-6">
                        @csrf
                        <div class="flex gap-3">
                            <textarea name="note" required placeholder="Add a note about this book..." rows="2" 
                                class="flex-1 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors resize-none"></textarea>
                            <button type="submit" class="px-5 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 transition-all self-start">
                                Add
                            </button>
                        </div>
                    </form>

                    <div class="space-y-4">
                        @forelse($book->notes()->latest()->get() as $note)
                            <div class="p-4 bg-gradient-to-r from-slate-50 to-slate-100/50 rounded-xl border border-slate-200/60">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3">
                                        <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center text-sm font-bold text-violet-700">
                                            {{ strtoupper(substr($note->user->name, 0, 1)) }}
                                        </span>
                                        <div>
                                            <span class="text-sm font-semibold text-slate-900">{{ $note->user->name }}</span>
                                            <span class="text-xs text-slate-500 ml-2">{{ $note->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    @if($note->user_id === auth()->id())
                                        <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Delete this note?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors p-1.5 hover:bg-red-50 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-700 whitespace-pre-wrap">{{ $note->note }}</p>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                </div>
                                <p class="text-slate-500 text-sm">No notes yet. Be the first to add one!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Loan History -->
                @if($book->loans()->where('status', 'returned')->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-5">Loan History</h3>
                        <div class="space-y-3">
                            @foreach($book->loans()->where('status', 'returned')->latest()->get() as $loan)
                                <div class="flex justify-between items-center py-3 px-4 bg-slate-50 rounded-xl">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $loan->borrower_name }}</p>
                                        @if($loan->notes)
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $loan->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right text-xs text-slate-500 bg-white px-3 py-1.5 rounded-lg">
                                        {{ $loan->borrowed_date->format('M d') }} - {{ $loan->returned_date->format('M d, Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Actions -->
            <div class="space-y-6">
                <!-- Reading Progress -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-5">Your Progress</h3>
                    
                    @if($userProgress && $book->total_pages)
                        <div class="mb-5 p-4 bg-gradient-to-r from-violet-50 to-indigo-50 rounded-xl border border-violet-100">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-3xl font-bold bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent">{{ round(($userProgress->current_page / $book->total_pages) * 100) }}%</span>
                                <span class="text-sm text-slate-600 font-medium">Page {{ $userProgress->current_page }} of {{ $book->total_pages }}</span>
                            </div>
                            <div class="w-full bg-white/80 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-violet-500 to-indigo-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ min(100, ($userProgress->current_page / $book->total_pages) * 100) }}%"></div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('books.progress.store', $book) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Current Page</label>
                            <input type="number" name="current_page" value="{{ $userProgress->current_page ?? 0 }}" min="0" 
                                @if($book->total_pages) max="{{ $book->total_pages }}" @endif required 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                            <select name="status" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors bg-white">
                                <option value="not_started" {{ ($userProgress->status ?? '') == 'not_started' ? 'selected' : '' }}>Not Started</option>
                                <option value="reading" {{ ($userProgress->status ?? '') == 'reading' ? 'selected' : '' }}>Reading</option>
                                <option value="completed" {{ ($userProgress->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full px-5 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 transition-all">
                            Update Progress
                        </button>
                    </form>
                </div>

                <!-- Loan Management -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-5">Lending</h3>
                    
                    @if($currentLoan && $currentLoan->status === 'borrowed')
                        <div class="p-5 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-200/60 mb-5">
                            <p class="text-xs font-semibold text-amber-700 uppercase tracking-wide">Currently with</p>
                            <p class="text-xl font-bold text-slate-900 mt-1">{{ $currentLoan->borrower_name }}</p>
                            @if($currentLoan->borrower_contact)
                                <p class="text-sm text-slate-600 mt-1">{{ $currentLoan->borrower_contact }}</p>
                            @endif
                            <p class="text-xs text-slate-500 mt-3">Since {{ $currentLoan->borrowed_date->format('M d, Y') }}</p>
                            @if($currentLoan->expected_return_date)
                                <p class="text-xs font-semibold mt-1 {{ $currentLoan->expected_return_date->isPast() ? 'text-red-600' : 'text-slate-600' }}">
                                    Expected: {{ $currentLoan->expected_return_date->format('M d, Y') }}
                                    @if($currentLoan->expected_return_date->isPast()) 
                                        <span class="ml-1 px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-[10px] uppercase">Overdue</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                        
                        <form method="POST" action="{{ route('loans.update', $currentLoan) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="returned_date" value="{{ date('Y-m-d') }}">
                            <button type="submit" class="w-full px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/25 transition-all">
                                Mark as Returned
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('books.loans.store', $book) }}" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Borrower Name *</label>
                                <input type="text" name="borrower_name" required 
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                    placeholder="Who is borrowing?">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Contact</label>
                                <input type="text" name="borrower_contact" 
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                    placeholder="Phone or email">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Date *</label>
                                    <input type="date" name="borrowed_date" value="{{ date('Y-m-d') }}" required 
                                        class="w-full px-3 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Return</label>
                                    <input type="date" name="expected_return_date" 
                                        class="w-full px-3 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Notes</label>
                                <textarea name="notes" rows="2" 
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors resize-none"
                                    placeholder="Any notes..."></textarea>
                            </div>
                            <button type="submit" class="w-full px-5 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600 shadow-lg shadow-amber-500/25 transition-all">
                                Record Loan
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Reading Progress from Others -->
                @if($book->readingProgress()->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-5">Family Progress</h3>
                        <div class="space-y-4">
                            @foreach($book->readingProgress as $progress)
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center text-sm font-bold text-violet-700">
                                            {{ strtoupper(substr($progress->user->name, 0, 1)) }}
                                        </span>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">{{ $progress->user->name }}</p>
                                            <p class="text-xs text-slate-500">{{ ucfirst(str_replace('_', ' ', $progress->status)) }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 bg-white px-3 py-1.5 rounded-lg">
                                        @if($book->total_pages)
                                            {{ round(($progress->current_page / $book->total_pages) * 100) }}%
                                        @else
                                            p.{{ $progress->current_page }}
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
