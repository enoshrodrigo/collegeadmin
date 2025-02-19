<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Event</h1>
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">
                @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" required
                          class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">{{ old('description', $event->description) }}</textarea>
                @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="link" class="block text-gray-700">More Photos Link (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $event->link) }}"
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">
                @error('link')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
 
        <!-- Existing Images Section (No delete button) -->
<div id="existing-photos" class="mt-4 grid grid-cols-3 gap-2">
    @foreach ($event->photos as $photo)
        <div class="relative border rounded-lg overflow-hidden">
            <img src="{{ Storage::url($photo->photo) }}" class="w-full h-24 object-cover rounded-md">
        </div>
    @endforeach
</div>

<!-- Drop Area for New Photos -->
<div id="drop-area" class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center bg-gray-100 hover:bg-gray-200 transition">
    <input type="file" name="photos[]" id="photos" multiple class="hidden" accept="image/*">
    <p class="text-gray-500">Drag & drop photos here or <span class="text-blue-500 cursor-pointer hover:underline" id="file-select">browse</span></p>
    <!-- New image previews will appear here -->
    <div id="preview" class="mt-4 grid grid-cols-3 gap-2"></div>
</div>


            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Update Event
                </button>
            </div>
        </form>
        <div class="mt-6">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">Back to Events</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById("photos");
            const dropArea = document.getElementById("drop-area");
            const fileSelect = document.getElementById("file-select");
            const previewContainer = document.getElementById("preview");

            let selectedFiles = []; // Store selected files

            fileSelect.addEventListener("click", () => fileInput.click());

            fileInput.addEventListener("change", function () {
                handleFiles(fileInput.files);
            });

            dropArea.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropArea.classList.add("bg-gray-200");
            });

            dropArea.addEventListener("dragleave", () => dropArea.classList.remove("bg-gray-200"));

            dropArea.addEventListener("drop", (e) => {
                e.preventDefault();
                dropArea.classList.remove("bg-gray-200");
                handleFiles(e.dataTransfer.files);
            });

            function handleFiles(files) {
                for (let i = 0; i < files.length; i++) {
                    if (!files[i].type.startsWith("image/")) continue;

                    selectedFiles.push(files[i]);

                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("relative", "border", "rounded-lg", "overflow-hidden");

                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(files[i]);
                    img.classList.add("w-full", "h-24", "object-cover", "rounded-md");

                    const removeBtn = document.createElement("button");
                    removeBtn.innerHTML = "✕";
                    removeBtn.classList.add("absolute", "top-1", "right-1", "bg-red-500", "text-white", "rounded-full", "px-2", "py-1", "text-xs", "hover:bg-red-700", "focus:outline-none");
                    removeBtn.onclick = () => {
                        previewContainer.removeChild(imgContainer);
                        selectedFiles = selectedFiles.filter(f => f !== files[i]); // Remove from array
                        updateFileInput();
                    };

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    previewContainer.appendChild(imgContainer);
                }
                updateFileInput();
            }

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
            }
        });

        function removePhoto(photoId) {
            // Send an AJAX request to remove the photo
            fetch(`/events/photos/${photoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    // Remove the photo from the UI
                    document.querySelector(`#photo-${photoId}`).remove();
                }
            });
        }
    </script>
</x-app-layout>
