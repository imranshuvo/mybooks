<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Book Library</h1>
            <p class="text-slate-500 mt-2">{{ $books->total() }} books in your collection</p>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-5 mb-8">
            <form method="GET" action="{{ route('books.index') }}">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, author, or ISBN..." 
                                class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                        </div>
                    </div>

                    <!-- Filter Dropdowns -->
                    <div class="flex flex-wrap gap-3">
                        <select name="language" class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 bg-white transition-colors">
                            <option value="">All Languages</option>
                            @foreach($languages as $language)
                                <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                            @endforeach
                        </select>

                        <select name="category" class="px-6 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 bg-white transition-colors">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>

                        <select name="status" class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 bg-white transition-colors">
                            <option value="">All Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="reading" {{ request('status') == 'reading' ? 'selected' : '' }}>Reading</option>
                        </select>

                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">
                            Search
                        </button>

                        @if(request()->anyFilled(['search', 'language', 'category', 'status', 'year']))
                            <a href="{{ route('books.index') }}" class="px-6 py-3 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($books as $book)
                    <a href="{{ route('books.show', $book) }}" class="group">
                        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                            <!-- Book Cover -->
                            <div class="aspect-[3/4] relative overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                                @if($book->cover_image)
                                    <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Status Badge -->
                                <span class="absolute top-3 right-3 text-xs px-2.5 py-1 rounded-lg font-medium shadow-sm backdrop-blur-sm
                                    {{ $book->status === 'available' ? 'bg-emerald-500/90 text-white' : '' }}
                                    {{ $book->status === 'borrowed' ? 'bg-amber-500/90 text-white' : '' }}
                                    {{ $book->status === 'reading' ? 'bg-violet-500/90 text-white' : '' }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </div>
                            <!-- Book Info -->
                            <div class="p-4">
                                <h3 class="font-semibold text-slate-900 text-sm leading-tight line-clamp-2 group-hover:text-violet-600 transition-colors">{{ $book->title }}</h3>
                                <p class="text-sm text-slate-500 mt-1.5 truncate">{{ $book->author }}</p>
                                <div class="flex items-center gap-2 mt-3">
                                    <span class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">{{ $book->language }}</span>
                                    @if($book->category)
                                        <span class="text-xs text-slate-400 truncate">{{ $book->category }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="mt-10">
                    {{ $books->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-16 text-center">
                <div class="w-24 h-24 mx-auto bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900">No books found</h3>
                <p class="mt-2 text-slate-500 max-w-sm mx-auto">
                    @if(request()->anyFilled(['search', 'language', 'category', 'status', 'year']))
                        Try adjusting your filters or search query.
                    @else
                        Get started by adding your first book to the library.
                    @endif
                </p>
                <div class="mt-8">
                    @if(request()->anyFilled(['search', 'language', 'category', 'status', 'year']))
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
                            Clear Filters
                        </a>
                    @else
                        <a href="{{ route('books.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Your First Book
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
