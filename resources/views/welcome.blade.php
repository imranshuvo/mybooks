<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>অক্ষর - Family Library</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="antialiased bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen">
    <!-- Modern Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-xl border-b border-slate-200/60 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-gradient-to-br from-violet-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">অক্ষর</span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Dashboard</a>
                        <a href="{{ route('books.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">My Books</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">Sign in</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="pt-32 pb-16 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-6 leading-tight tracking-tight">
                    Our Family<br><span class="bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent">Book Shelf</span>
                </h1>
                <p class="text-xl text-slate-500 mb-10 leading-relaxed">
                    Browse, track, and discover books from our home library
                </p>
                <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-white border border-slate-200/60 rounded-2xl shadow-sm text-sm text-slate-700">
                    <div class="w-8 h-8 bg-gradient-to-br from-violet-100 to-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">{{ $books->total() }} books</span> in collection
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="px-6 pb-12">
        <div class="max-w-7xl mx-auto">
            <form method="GET" action="{{ route('welcome') }}" class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-5">
                    <div class="md:col-span-2">
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Search by title, author, or ISBN..." 
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                            >
                        </div>
                    </div>
                    <div>
                        <select name="language" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                            <option value="">Language</option>
                            @foreach($languages as $language)
                                <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="category" class="w-full px-6 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                            <option value="">Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                            <option value="">Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="reading" {{ request('status') == 'reading' ? 'selected' : '' }}>Reading</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Showing {{ $books->count() }} of {{ $books->total() }} books</span>
                    <div class="flex gap-3">
                        <a href="{{ route('welcome') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Clear</a>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="px-6 pb-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @forelse($books as $book)
                    <a href="{{ route('book.public.show', $book) }}" class="group block">
                        <div class="bg-white border border-slate-200/60 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                            @if($book->cover_image)
                                <div class="aspect-[3/4] overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                                    <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="aspect-[3/4] bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4">
                                    <h3 class="font-semibold text-slate-900 text-base mb-1 line-clamp-2 group-hover:text-violet-600 transition-colors">{{ $book->title }}</h3>
                                    <p class="text-sm text-slate-500 mb-3">{{ $book->author }}</p>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg">{{ $book->language }}</span>
                                        <span class="px-2.5 py-1 rounded-lg font-medium
                                            {{ $book->status === 'available' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : '' }}
                                            {{ $book->status === 'borrowed' ? 'bg-amber-50 text-amber-700 border border-amber-200/60' : '' }}
                                            {{ $book->status === 'reading' ? 'bg-violet-50 text-violet-700 border border-violet-200/60' : '' }}">
                                            {{ ucfirst($book->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-16 text-center">
                            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-900 mb-2">No books found</h3>
                            <p class="text-slate-500">Try adjusting your search filters</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="mt-12">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    @guest
        <div class="px-6 pb-20">
            <div class="max-w-4xl mx-auto bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-12 text-center shadow-2xl">
                <h2 class="text-3xl font-bold text-white mb-4">Family Members</h2>
                <p class="text-slate-300 text-lg mb-10">Sign in to manage the collection, track reading progress, and more</p>
                <a href="{{ route('login') }}" class="px-8 py-3.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 transition-all duration-200">Sign In</a>
            </div>
        </div>
    @endguest

    <!-- Footer -->
    <footer class="border-t border-slate-200/60 bg-white/50 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-violet-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">অক্ষর</span>
                </div>
                <p class="text-sm text-slate-500">&copy; {{ date('Y') }} অক্ষর · Family Library</p>
            </div>
        </div>
    </footer>
</body>
</html>
