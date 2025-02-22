<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <!-- Card Container -->
        <div class="bg-white shadow rounded-lg p-6  m-auto" style="max-width: fit-content;">
            <h1 class="text-3xl font-bold mb-5 text-center">Edit Event</h1>
            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Event Title -->
                    <div class="mb-1">
                        <label for="title" class="block text-gray-700 font-semibold">Event Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                               class="mt-1 block w-full rounded-md border border-gray-800 px-4 py-2 focus:ring focus:ring-blue-300">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- More Photos Link -->
                    <div class="mb-1">
                        <label for="link" class="block text-gray-700 font-semibold">More Photos Link (Optional)</label>
                        <input type="url" name="link" id="link" value="{{ old('link', $event->link) }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-300">
                        @error('link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- date --}}
                    <div class="mb-1">
                        <label for="date" class="block text-gray-700 font-semibold">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $event->date) }}" required
                               class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-300">
                        @error('date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- status --}}
                    <div class="mb-1">
                        <label for="status" class="block text-gray-700 font-semibold">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 focus:ring focus:ring-blue-300">
                            <option value="1" {{ old('status', $event->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $event->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Description (Full width) -->
                    <div class="mb-1 md:col-span-2">
                        <label for="description" class="block text-gray-700 font-semibold">Description</label>
                        <!-- Hidden input to store the editor content -->
                        <input type="hidden" name="description" id="hidden-description">
                        <!-- Quill Editor container pre-filled with the event description -->
                        <div id="editor" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300" style="height: 300px;">
                            {!! old('description', $event->description) !!}
                        </div>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Existing Photos (Full width) -->
                <div id="existing-photos" class="mt-4 grid grid-cols-3 gap-2">
                    @foreach ($event->photos as $photo)
                        <div class="relative border rounded-lg overflow-hidden">
                            <img src="{{ Storage::url($photo->photo) }}" class="w-full h-24 object-cover rounded-md">
                        </div>
                    @endforeach
                </div>
                
                <!-- Upload Photos (Full width) -->
                <div id="drop-area" class="mt-4 border-2 border-dashed border-gray-300 p-6 rounded-lg text-center bg-gray-100 hover:bg-gray-200 transition">
                    <input type="file" name="photos[]" id="photos" multiple class="hidden" accept="image/*">
                    <p class="text-gray-500">
                        Drag & drop photos here or 
                        <span class="text-blue-500 cursor-pointer hover:underline" id="file-select">browse</span>
                    </p>
                    <div id="preview" class="mt-4 grid grid-cols-3 gap-2"></div>
                </div>
                
                <!-- Submit Button -->
                <div class="mt-6 text-center">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">Back to Events</a>
        </div>
    </div>
    
    <!-- Include Quill CSS & JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize Quill Editor with placeholder and existing content
            var quill = new Quill("#editor", {
                theme: "snow",
                placeholder: "Write event description here...",
                modules: {
                    toolbar: [
                        [{ 'header': '1'}, {'header': '2'}, { 'font': [] }],
                        [{size: []}],
                        ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                        [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                        ['link'],
                        ['clean'],
                        ['code-block'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }]
                    ]
                }
            });
            
            // Update the hidden input with Quill content
            function updateHiddenInput() {
                document.getElementById("hidden-description").value = quill.root.innerHTML;
            }
            
            updateHiddenInput();
            quill.on('text-change', updateHiddenInput);
            
            // Also update hidden input on form submission
            var form = document.querySelector("form");
            form.addEventListener("submit", updateHiddenInput);
            
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
                Array.from(files).forEach(file => {
                    if (!file.type.startsWith("image/")) return;
    
                    selectedFiles.push(file);
    
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("relative", "border", "rounded-lg", "overflow-hidden");
    
                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.classList.add("w-full", "h-24", "object-cover", "rounded-md");
    
                    const removeBtn = document.createElement("button");
                    removeBtn.innerHTML = "✕";
                    removeBtn.classList.add("absolute", "top-1", "right-1", "bg-red-500", "text-white", "rounded-full", "px-2", "py-1", "text-xs", "hover:bg-red-700", "focus:outline-none");
                    removeBtn.addEventListener("click", function(e) {
                        e.preventDefault();
                        previewContainer.removeChild(imgContainer);
                        selectedFiles = selectedFiles.filter(f => f !== file);
                        updateFileInput();
                    });
    
                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    previewContainer.appendChild(imgContainer);
                });
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
