<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Event Details -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>
            <div class="mt-2 text-gray-600">
                <span class="font-semibold">Date:</span> {{ $event->date }}
            </div>
            {{-- status 0 or 1 active or inactive with red or green color--}}
            <div class="mt-2 text-gray-600">
                <span class="font-semibold">Status:</span>
                <span class="px-2 py-1 text-sm rounded-full {{ $event->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $event->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
           
            <div class="mt-2 text-gray-600  prose">{!! $event->description !!}</div>
            @if($event->link)
                <a href="{{ $event->link }}" target="_blank" class="mt-2 inline-block text-blue-600 hover:underline">
                    View More Photos
                </a>
            @endif
        </div>

        <!-- Responsive Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($event->photos as $photo)
                <div class="relative group cursor-pointer">
                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="Event Photo"
                         class="w-full h-48 object-cover rounded-lg shadow-md"
                         onclick="openModal('{{ asset('storage/' . $photo->photo) }}')">
                    <!-- Delete Button for Each Photo -->
                    <form action="{{ route('events.photos.destroy', ['event' => $event->id, 'photo' => $photo->id]) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to delete this photo?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">
                Back to Events
            </a>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden z-50">
        <div class="relative">
            <button id="closeModal" class="absolute top-0 right-0 mt-4 mr-4 text-white text-3xl">&times;</button>
            <img id="modalImage" src="" alt="Large Event Photo" class="max-w-full max-h-screen rounded shadow-lg">
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
        }
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('modalImage').src = '';
        });
        // Optional: Close modal if clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                document.getElementById('modalImage').src = '';
            }
        });
    </script>
</x-app-layout>
