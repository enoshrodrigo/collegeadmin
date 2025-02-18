<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Event</h1>
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300">
                @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" required
                          class="mt-1 block w-full rounded-md border-gray-300">{{ old('description', $event->description) }}</textarea>
                @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="link" class="block text-gray-700">More Photos Link (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $event->link) }}"
                       class="mt-1 block w-full rounded-md border-gray-300">
                @error('link')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="photos" class="block text-gray-700">Upload Additional Photos</label>
                <input type="file" name="photos[]" id="photos" multiple
                       class="mt-1 block w-full">
                @error('photos.*')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Existing Photos</h2>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($event->photos as $photo)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $photo->photo) }}" alt="Event Photo" class="w-full h-32 object-cover rounded">
                            <!-- Optionally, you could add individual delete buttons for each photo here -->
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Update Event
                </button>
            </div>
        </form>
        <div class="mt-6">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">Back to Events</a>
        </div>
    </div>
</x-app-layout>
