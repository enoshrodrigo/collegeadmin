<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Create Event</h1>
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="mt-1 block w-full rounded-md border-gray-300">
                @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" required
                          class="mt-1 block w-full rounded-md border-gray-300">{{ old('description') }}</textarea>
                @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="link" class="block text-gray-700">More Photos Link (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}"
                       class="mt-1 block w-full rounded-md border-gray-300">
                @error('link')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="photos" class="block text-gray-700">Upload Photos</label>
                <input type="file" name="photos[]" id="photos" multiple
                       class="mt-1 block w-full">
                @error('photos.*')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Save Event
                </button>
            </div>
        </form>
        <div class="mt-6">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">Back to Events</a>
        </div>
    </div>
</x-app-layout>
