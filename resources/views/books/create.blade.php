<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Books
            </a>
            <h1 class="text-3xl font-bold text-slate-900">Add New Book</h1>
            <p class="text-slate-500 mt-2">Fill in the details to add a book to your library</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-6 sm:p-8 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-900 mb-2">Title <span class="text-rose-500">*</span></label>
                        <input id="title" type="text" name="title" value="{{ old('title') }}" required autofocus 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                            placeholder="Enter book title">
                        @error('title')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-semibold text-slate-900 mb-2">Author <span class="text-rose-500">*</span></label>
                        <input id="author" type="text" name="author" value="{{ old('author') }}" required 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                            placeholder="Enter author name">
                        @error('author')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Language & Category -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="language" class="block text-sm font-semibold text-slate-900 mb-2">Language <span class="text-rose-500">*</span></label>
                            <input id="language" type="text" name="language" value="{{ old('language', 'Bangla') }}" required 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                            @error('language')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-semibold text-slate-900 mb-2">Category</label>
                            <input id="category" type="text" name="category" value="{{ old('category') }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="Fiction, Science, etc.">
                            @error('category')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- ISBN & Publisher -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="isbn" class="block text-sm font-semibold text-slate-900 mb-2">ISBN</label>
                            <input id="isbn" type="text" name="isbn" value="{{ old('isbn') }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="978-3-16-148410-0">
                            @error('isbn')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="publisher" class="block text-sm font-semibold text-slate-900 mb-2">Publisher</label>
                            <input id="publisher" type="text" name="publisher" value="{{ old('publisher') }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="Publisher name">
                            @error('publisher')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Year & Pages -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="publication_year" class="block text-sm font-semibold text-slate-900 mb-2">Publication Year</label>
                            <input id="publication_year" type="number" name="publication_year" value="{{ old('publication_year') }}" 
                                min="1000" max="{{ date('Y') + 1 }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="{{ date('Y') }}">
                            @error('publication_year')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="total_pages" class="block text-sm font-semibold text-slate-900 mb-2">Total Pages</label>
                            <input id="total_pages" type="number" name="total_pages" value="{{ old('total_pages') }}" min="1" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="300">
                            @error('total_pages')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-900 mb-2">Status <span class="text-rose-500">*</span></label>
                        <select id="status" name="status" required 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 bg-white transition-colors">
                            <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="borrowed" {{ old('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="reading" {{ old('status') == 'reading' ? 'selected' : '' }}>Reading</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cover Image -->
                    <div>
                        <label for="cover_image" class="block text-sm font-semibold text-slate-900 mb-2">Cover Image</label>
                        <div class="relative">
                            <input id="cover_image" type="file" name="cover_image" accept="image/*" 
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 file:cursor-pointer cursor-pointer border border-slate-200 rounded-xl">
                        </div>
                        <p class="mt-2 text-xs text-slate-500">JPG, PNG or GIF. Max 2MB.</p>
                        @error('cover_image')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 resize-none transition-colors"
                            placeholder="Brief description of the book...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 sm:px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('books.index') }}" class="px-6 py-3 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-violet-600 to-indigo-600 rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 hover:shadow-violet-500/40 transition-all duration-200">
                        Add Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
