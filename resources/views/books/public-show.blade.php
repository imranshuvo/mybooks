<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $book->title }} - অক্ষর</title>
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="{{ $book->title }} by {{ $book->author }}">
    <meta property="og:description" content="{{ Str::limit($book->description ?? 'A book from our family library', 160) }}">
    @if($book->cover_image)
    <meta property="og:image" content="{{ asset($book->cover_image) }}">
    @endif
    <meta property="og:type" content="book">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/25">
                            <span class="text-white font-bold text-lg">অ</span>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent">অক্ষর</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('welcome') }}" class="text-slate-600 hover:text-slate-900 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Library
                    </a>
                    @auth
                        <a href="{{ route('books.show', $book) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 transition shadow-lg shadow-violet-500/25">
                            Manage Book
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 transition shadow-lg shadow-violet-500/25">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Book Detail Card -->
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Cover Image - Left Half -->
                    <div class="lg:w-1/2 p-8 lg:p-12 bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center min-h-[300px] lg:min-h-[600px]">
                        @if($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="max-h-[450px] lg:max-h-[500px] w-auto rounded-2xl shadow-2xl shadow-slate-300/50">
                        @else
                            <div class="w-48 lg:w-64 aspect-[3/4] bg-gradient-to-br from-violet-100 to-indigo-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-20 lg:w-24 h-20 lg:h-24 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Book Info - Right Half -->
                    <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                        <!-- Status Badge -->
                        <div class="mb-4">
                            @php
                                $statusColors = [
                                    'available' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'borrowed' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'reading' => 'bg-violet-100 text-violet-700 border-violet-200',
                                ];
                                $statusIcons = [
                                    'available' => '✓',
                                    'borrowed' => '↗',
                                    'reading' => '📖',
                                ];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium border {{ $statusColors[$book->status] ?? $statusColors['available'] }}">
                                <span>{{ $statusIcons[$book->status] ?? '📚' }}</span>
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>

                        <!-- Title & Author -->
                        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">{{ $book->title }}</h1>
                        <p class="text-xl text-slate-600 mb-6">by <span class="font-medium text-slate-800">{{ $book->author }}</span></p>

                        <!-- Quick Info Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                            @if($book->language)
                            <div class="bg-slate-50 rounded-xl p-4 text-left" style="padding-left: 0;">
                                <p class="text-xs text-slate-500 uppercase tracking-wide mb-1">Language</p>
                                <p class="font-semibold text-slate-900">{{ $book->language }}</p>
                            </div>
                            @endif
                            @if($book->publication_year)
                            <div class="bg-slate-50 rounded-xl p-4 text-left" style="padding-left: 0;">
                                <p class="text-xs text-slate-500 uppercase tracking-wide mb-1">Published</p>
                                <p class="font-semibold text-slate-900">{{ $book->publication_year }}</p>
                            </div>
                            @endif
                            @if($book->total_pages)
                            <div class="bg-slate-50 rounded-xl p-4 text-left" style="padding-left: 0;">
                                <p class="text-xs text-slate-500 uppercase tracking-wide mb-1">Pages</p>
                                <p class="font-semibold text-slate-900">{{ $book->total_pages }}</p>
                            </div>
                            @endif
                            @if($book->category)
                            <div class="bg-slate-50 rounded-xl p-4 text-left" style="padding-left: 0;">
                                <p class="text-xs text-slate-500 uppercase tracking-wide mb-1">Category</p>
                                <p class="font-semibold text-slate-900">{{ $book->category }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Additional Details -->
                        <div class="space-y-4 mb-8">
                            @if($book->publisher)
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span>Published by <strong class="text-slate-800">{{ $book->publisher }}</strong></span>
                            </div>
                            @endif
                            @if($book->isbn)
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span>ISBN: <strong class="text-slate-800 font-mono">{{ $book->isbn }}</strong></span>
                            </div>
                            @endif
                            @if($book->addedBy)
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Added by <strong class="text-slate-800">{{ $book->addedBy->name }}</strong></span>
                            </div>
                            @endif
                        </div>

                        <!-- Description -->
                        @if($book->description)
                        <div class="border-t border-slate-200 pt-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-3">About this book</h2>
                            <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $book->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Books -->
            @if($relatedBooks->count() > 0)
            <div class="py-12 mt-16 border-t border-slate-200">
                <h2 class="text-xl font-bold text-slate-900 mb-6">More from this category</h2>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                    @foreach($relatedBooks as $relatedBook)
                    <a href="{{ route('book.public.show', $relatedBook) }}" class="group" style="width: calc(50% - 0.5rem); max-width: 250px; flex-shrink: 0;">
                        <div class="bg-white border border-slate-200/60 rounded-xl overflow-hidden shadow-sm hover:shadow-lg hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                            @if($relatedBook->cover_image)
                                <div class="aspect-[3/4] overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                                    <img src="{{ asset($relatedBook->cover_image) }}" alt="{{ $relatedBook->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="aspect-[3/4] bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-3">
                                <h3 class="font-medium text-slate-900 text-xs line-clamp-2 group-hover:text-violet-600 transition-colors">{{ $relatedBook->title }}</h3>
                                <p class="text-slate-500 text-xs mt-1 truncate">{{ $relatedBook->author }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200/60 bg-white/50 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-slate-500">&copy; {{ date('Y') }} অক্ষর · Family Library</p>
        </div>
    </footer>
</body>
</html>
