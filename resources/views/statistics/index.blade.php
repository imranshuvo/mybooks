<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Statistics</h1>
                <p class="text-slate-500 mt-2">Library overview and analytics</p>
            </div>
            <a href="{{ route('statistics.export-pdf') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export PDF
            </a>
        </div>

        <!-- Overview Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-10">
            <div class="group bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 hover:shadow-lg hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Total Books</p>
                        <p class="text-4xl font-bold text-slate-900">{{ $stats['total_books'] }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 hover:shadow-lg hover:shadow-emerald-100/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Available</p>
                        <p class="text-4xl font-bold text-emerald-600">{{ $stats['available_books'] }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 hover:shadow-lg hover:shadow-amber-100/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Borrowed</p>
                        <p class="text-4xl font-bold text-amber-600">{{ $stats['borrowed_books'] }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 hover:shadow-lg hover:shadow-violet-100/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Members</p>
                        <p class="text-4xl font-bold text-violet-600">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-violet-100 to-violet-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 flex items-center gap-5">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-yellow-200 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">{{ $stats['total_loans'] }}</p>
                    <p class="text-sm text-slate-500">Total Loans</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 flex items-center gap-5">
                <div class="w-14 h-14 bg-gradient-to-br from-rose-100 to-rose-200 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">{{ $stats['active_loans'] }}</p>
                    <p class="text-sm text-slate-500">Active Loans</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 flex items-center gap-5">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">{{ $stats['completed_reads'] }}</p>
                    <p class="text-sm text-slate-500">Completed Reads</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Books by Language -->
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-6">By Language</h3>
                <div class="space-y-5">
                    @foreach($stats['books_by_language'] as $lang)
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-slate-700">{{ $lang->language }}</span>
                                <span class="text-sm font-bold text-slate-900">{{ $lang->count }}</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-violet-500 to-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ $stats['total_books'] > 0 ? ($lang->count / $stats['total_books']) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Contributors -->
            @if($stats['top_contributors']->count() > 0)
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-6">Top Contributors</h3>
                    <div class="space-y-3">
                        @foreach($stats['top_contributors'] as $index => $contributor)
                            <div class="flex items-center justify-between p-4 rounded-xl {{ $index === 0 ? 'bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-200/60' : 'bg-slate-50' }}">
                                <div class="flex items-center gap-4">
                                    <span class="w-10 h-10 rounded-xl {{ $index === 0 ? 'bg-gradient-to-br from-amber-400 to-yellow-500 text-white shadow-lg shadow-amber-200' : 'bg-slate-200 text-slate-600' }} flex items-center justify-center text-sm font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="text-sm font-semibold text-slate-900">{{ $contributor->name }}</span>
                                </div>
                                <span class="text-sm font-bold text-slate-600 bg-white px-3 py-1 rounded-lg">{{ $contributor->books_added_count }} {{ Str::plural('book', $contributor->books_added_count) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Books by Category -->
        @if($stats['books_by_category']->count() > 0)
            <div class="mt-8 bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-6">By Category</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($stats['books_by_category'] as $category)
                        <div class="text-center p-5 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200/60 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                            <p class="text-3xl font-bold text-slate-900">{{ $category->count }}</p>
                            <p class="text-sm text-slate-500 mt-1.5 truncate">{{ $category->category }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
