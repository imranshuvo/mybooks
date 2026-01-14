<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Welcome Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-slate-900">Welcome back, {{ Auth::user()->name }}</h1>
            <p class="text-slate-500 mt-2">Here's what's happening with your book collection</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
            <div class="group bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm hover:shadow-lg hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Total Books</p>
                        <p class="text-4xl font-bold text-slate-900">{{ $totalBooks }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="group bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm hover:shadow-lg hover:shadow-emerald-100/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Available</p>
                        <p class="text-4xl font-bold text-emerald-600">{{ $availableBooks }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="group bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm hover:shadow-lg hover:shadow-amber-100/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Borrowed</p>
                        <p class="text-4xl font-bold text-amber-600">{{ $borrowedBooks }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="group bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm hover:shadow-lg hover:shadow-violet-100/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Your Additions</p>
                        <p class="text-4xl font-bold text-violet-600">{{ $booksAddedByUser }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-violet-100 to-violet-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Books - Takes 2 columns -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
                    <div class="flex justify-between items-center p-6 border-b border-slate-100">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Recent Books</h3>
                            <p class="text-sm text-slate-500 mt-0.5">Your latest additions to the library</p>
                        </div>
                        <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-violet-600 hover:text-violet-700 transition-colors">
                            View all
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    
                    @if($recentBooks->count() > 0)
                        <div class="divide-y divide-slate-100">
                            @foreach($recentBooks as $book)
                                <a href="{{ route('books.show', $book) }}" class="flex items-center p-5 hover:bg-slate-50/80 transition-colors group">
                                    @if($book->cover_image)
                                        <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded-xl shadow-sm group-hover:shadow-md transition-shadow flex-shrink-0">
                                    @else
                                        <div class="w-16 h-24 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="ml-5 flex-1 min-w-0">
                                        <p class="font-semibold text-slate-900 group-hover:text-violet-600 transition-colors truncate">{{ $book->title }}</p>
                                        <p class="text-sm text-slate-500 mt-0.5 truncate">{{ $book->author }}</p>
                                        <div class="mt-2 flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $book->status === 'available' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : ($book->status === 'borrowed' ? 'bg-amber-50 text-amber-700 border border-amber-200/60' : 'bg-violet-50 text-violet-700 border border-violet-200/60') }}">
                                                {{ ucfirst($book->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-300 group-hover:text-violet-500 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 px-6">
                            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center mb-5">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            </div>
                            <h4 class="font-semibold text-slate-900 mb-2">No books yet</h4>
                            <p class="text-slate-500 mb-6">Start building your personal library</p>
                            <a href="{{ route('books.create') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Add your first book
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Reading Progress -->
                @if($userReadingProgress->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100">
                            <h3 class="font-semibold text-slate-900 flex items-center">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                Currently Reading
                            </h3>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @foreach($userReadingProgress as $progress)
                                <a href="{{ route('books.show', $progress->book) }}" class="block p-5 hover:bg-slate-50/80 transition-colors group">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="min-w-0 flex-1">
                                            <p class="font-medium text-slate-900 group-hover:text-violet-600 transition-colors truncate">{{ $progress->book->title }}</p>
                                            <p class="text-sm text-slate-500">{{ $progress->book->author }}</p>
                                        </div>
                                        <span class="text-sm font-bold text-slate-900 ml-2 bg-slate-100 px-2 py-1 rounded-lg">
                                            @if($progress->book->total_pages)
                                                {{ round(($progress->current_page / $progress->book->total_pages) * 100) }}%
                                            @else
                                                p.{{ $progress->current_page }}
                                            @endif
                                        </span>
                                    </div>
                                    @if($progress->book->total_pages)
                                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                            <div class="bg-gradient-to-r from-violet-500 to-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ min(100, ($progress->current_page / $progress->book->total_pages) * 100) }}%"></div>
                                        </div>
                                        <p class="text-xs text-slate-400 mt-2">Page {{ $progress->current_page }} of {{ $progress->book->total_pages }}</p>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Borrowed Books -->
                @if($currentlyBorrowed->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100">
                            <h3 class="font-semibold text-slate-900 flex items-center">
                                <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                                Borrowed Out
                            </h3>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @foreach($currentlyBorrowed as $loan)
                                <a href="{{ route('books.show', $loan->book) }}" class="block p-5 hover:bg-slate-50/80 transition-colors group">
                                    <p class="font-medium text-slate-900 group-hover:text-violet-600 transition-colors truncate">{{ $loan->book->title }}</p>
                                    <div class="flex items-center mt-2 text-sm text-slate-500">
                                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        {{ $loan->borrower_name }}
                                    </div>
                                    @if($loan->expected_return_date)
                                        <p class="text-xs mt-2 {{ $loan->expected_return_date->isPast() ? 'text-rose-600 font-medium' : 'text-slate-400' }}">
                                            <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $loan->expected_return_date->format('M d, Y') }}
                                            @if($loan->expected_return_date->isPast())
                                                · Overdue
                                            @endif
                                        </p>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl p-6 shadow-xl">
                    <h3 class="font-semibold text-white mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('books.create') }}" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-200 group">
                            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-violet-500/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            Add new book
                        </a>
                        <a href="{{ route('books.index') }}" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-200 group">
                            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-violet-500/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            </div>
                            Browse all books
                        </a>
                        <a href="{{ route('statistics.index') }}" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-200 group">
                            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-violet-500/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            View statistics
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
