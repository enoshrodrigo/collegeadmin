<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Create News</h1>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" x-data="{ action: 'link' }">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full" required>
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Button Text -->
            <div class="mb-4">
                <label for="button_text" class="block text-gray-700">Button Text</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('button_text')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Type -->
            <div class="mb-4">
                <span class="block text-gray-700">Action Type</span>
                <label class="inline-flex items-center mt-1">
                    <input type="radio" class="form-radio" name="action" value="link" x-model="action" checked>
                    <span class="ml-2">Link</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" class="form-radio" name="action" value="more_info" x-model="action">
                    <span class="ml-2">More Info</span>
                </label>
                @error('action')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Link Input (Shown if "Link" is selected) -->
            <div class="mb-4" x-show="action === 'link'">
                <label for="action_link" class="block text-gray-700">Action Link (URL)</label>
                <input type="url" name="action_link" id="action_link" value="{{ old('action_link') }}"
                    class="mt-1 block w-full rounded-md border-gray-300">
                @error('action_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- More Info Editor (Shown if "More Info" is selected) -->
            <div class="mb-4" x-show="action === 'more_info'">
                <label for="more_info" class="block text-gray-700">More Info</label>
                <input id="more_info" type="hidden" name="more_info" value="{{ old('more_info') }}">
                <trix-editor input="more_info" class="trix-content"></trix-editor>
                @error('more_info')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save News
                </button>
            </div>
        </form>
    </div>

    <!-- Include Trix Editor CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <!-- Alpine.js for toggling action fields -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
