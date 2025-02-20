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
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <!-- Quill editor container pre-filled with the event description -->
                <div id="editor" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">
                    {!! old('description', $event->description) !!}
                </div>
                <!-- Hidden input to store the editor content -->
                <input type="hidden" name="description" id="hidden-description">
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="link" class="block text-gray-700">More Photos Link (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $event->link) }}"
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">
                @error('link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div id="existing-photos" class="mt-4 grid grid-cols-3 gap-2">
                @foreach ($event->photos as $photo)
                    <div class="relative border rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($photo->photo) }}" class="w-full h-24 object-cover rounded-md">
                    </div>
                @endforeach
            </div>

            <div id="drop-area" class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center bg-gray-100 hover:bg-gray-200 transition">
                <input type="file" name="photos[]" id="photos" multiple class="hidden" accept="image/*">
                <p class="text-gray-500">
                    Drag & drop photos here or 
                    <span class="text-blue-500 cursor-pointer hover:underline" id="file-select">browse</span>
                </p>
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

    <!-- Quill JS and CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize Quill Editor with a placeholder and existing content
            var quill = new Quill("#editor", {
                theme: "snow",
                placeholder: "Write event description here..."
            });

            // Update the hidden input initially and on every text change
            function updateHiddenInput() {
                document.getElementById("hidden-description").value = quill.root.innerHTML;
            }

            // Set the hidden input with the current editor content immediately
            updateHiddenInput();

            // Listen for changes in the Quill editor and update hidden input
            quill.on('text-change', function() {
                updateHiddenInput();
            });

            // Also update the hidden input on form submission
            var form = document.querySelector("form");
            form.addEventListener("submit", function () {
                updateHiddenInput();
            });

            // File Upload Logic
            const fileInput = document.getElementById("photos");
            const dropArea = document.getElementById("drop-area");
            const fileSelect = document.getElementById("file-select");
            const previewContainer = document.getElementById("preview");

            let selectedFiles = [];

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
                    let file = files[i];
                    if (!file.type.startsWith("image/")) continue;

                    selectedFiles.push(file);

                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("relative", "border", "rounded-lg", "overflow-hidden");

                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.classList.add("w-full", "h-24", "object-cover", "rounded-md");

                    const removeBtn = document.createElement("button");
                    removeBtn.innerHTML = "✕";
                    removeBtn.classList.add("absolute", "top-1", "right-1", "bg-red-500", "text-white", "rounded-full", "px-2", "py-1", "text-xs", "hover:bg-red-700", "focus:outline-none");
                    removeBtn.onclick = () => {
                        previewContainer.removeChild(imgContainer);
                        selectedFiles = selectedFiles.filter(f => f !== file);
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
    </script>
</x-app-layout>
