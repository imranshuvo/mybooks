<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('books.show', $book) }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-violet-600 transition-colors text-sm font-medium mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Book
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Edit Book</h2>
            <p class="text-sm text-slate-500 mt-1">{{ $book->title }}</p>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-8 space-y-6">
                    <!-- Current Cover Preview -->
                    @if($book->cover_image)
                        <div class="flex items-center gap-5 p-5 bg-gradient-to-r from-slate-50 to-slate-100 rounded-xl border border-slate-200/60">
                            <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded-lg shadow-md">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Current cover</p>
                                <p class="text-xs text-slate-500 mt-1">Upload a new image below to replace it</p>
                            </div>
                        </div>
                    @endif

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-900 mb-2">Title <span class="text-red-500">*</span></label>
                        <input id="title" type="text" name="title" value="{{ old('title', $book->title) }}" required autofocus 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                            placeholder="Enter book title">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-semibold text-slate-900 mb-2">Author <span class="text-red-500">*</span></label>
                        <input id="author" type="text" name="author" value="{{ old('author', $book->author) }}" required 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                            placeholder="Enter author name">
                        @error('author')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Language & Category -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="language" class="block text-sm font-semibold text-slate-900 mb-2">Language <span class="text-red-500">*</span></label>
                            <input id="language" type="text" name="language" value="{{ old('language', $book->language) }}" required 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors">
                            @error('language')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-semibold text-slate-900 mb-2">Category</label>
                            <input id="category" type="text" name="category" value="{{ old('category', $book->category) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="Fiction, Science, etc.">
                            @error('category')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- ISBN & Publisher -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="isbn" class="block text-sm font-semibold text-slate-900 mb-2">ISBN</label>
                            <input id="isbn" type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="978-3-16-148410-0">
                            @error('isbn')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="publisher" class="block text-sm font-semibold text-slate-900 mb-2">Publisher</label>
                            <input id="publisher" type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="Publisher name">
                            @error('publisher')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Year & Pages -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="publication_year" class="block text-sm font-semibold text-slate-900 mb-2">Publication Year</label>
                            <input id="publication_year" type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}" 
                                min="1000" max="{{ date('Y') + 1 }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="{{ date('Y') }}">
                            @error('publication_year')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="total_pages" class="block text-sm font-semibold text-slate-900 mb-2">Total Pages</label>
                            <input id="total_pages" type="number" name="total_pages" value="{{ old('total_pages', $book->total_pages) }}" min="1" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors"
                                placeholder="300">
                            @error('total_pages')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-900 mb-2">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" required 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors bg-white">
                            <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="borrowed" {{ old('status', $book->status) == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="reading" {{ old('status', $book->status) == 'reading' ? 'selected' : '' }}>Reading</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cover Image -->
                    <div>
                        <label for="cover_image" class="block text-sm font-semibold text-slate-900 mb-2">Cover Image</label>
                        <div class="relative">
                            <input id="cover_image" type="file" name="cover_image" accept="image/*" 
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-violet-50 file:to-indigo-50 file:text-violet-700 hover:file:from-violet-100 hover:file:to-indigo-100 file:cursor-pointer cursor-pointer border border-slate-200 rounded-xl transition-colors">
                        </div>
                        <p class="mt-2 text-xs text-slate-500">JPG, PNG or GIF. Max 2MB. Leave empty to keep current image.</p>
                        @error('cover_image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-colors resize-none"
                            placeholder="Brief description of the book...">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-8 py-5 bg-gradient-to-r from-slate-50 to-slate-100 border-t border-slate-200/60 flex justify-between items-center">
                    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl transition-colors">
                            Delete Book
                        </button>
                    </form>
                    <div class="flex gap-3">
                        <a href="{{ route('books.show', $book) }}" class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-violet-600 to-indigo-600 rounded-xl hover:from-violet-700 hover:to-indigo-700 shadow-lg shadow-violet-500/25 transition-all">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
