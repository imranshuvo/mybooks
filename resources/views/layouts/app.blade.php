<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'অক্ষর') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
            .glass { backdrop-filter: blur(12px); background: rgba(255, 255, 255, 0.85); }
            .gradient-border { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
            .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15); }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/60 sticky top-16 z-40">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 py-12" x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="bg-emerald-50 border border-emerald-200/60 text-emerald-800 px-5 py-4 rounded-2xl flex items-center justify-between shadow-sm" role="alert">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 py-12" x-data="{ show: true }" x-show="show">
                    <div class="bg-rose-50 border border-rose-200/60 text-rose-800 px-5 py-4 rounded-2xl flex items-center justify-between shadow-sm" role="alert">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-rose-600 hover:text-rose-800 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="py-12">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="border-t border-slate-200/60 bg-white/50 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <p class="text-center text-sm text-slate-500">&copy; {{ date('Y') }} অক্ষর · Family Library</p>
                </div>
            </footer>
        </div>
    </body>
</html>
