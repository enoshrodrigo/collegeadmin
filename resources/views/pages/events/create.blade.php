<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Create Event</h1>
        <!-- The form submission calls submitEditorContent() -->
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" onsubmit="submitEditorContent()">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">
                @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <!-- Text Editor Section using Quill -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <!-- Hidden input to hold the editor's content -->
                <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                <!-- Quill Editor container -->
                <div id="editor" class="mt-1 block w-full rounded-md border border-gray-300" style="height: 300px;"></div>
                @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div class="mb-4">
                <label for="link" class="block text-gray-700">More Photos Link (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}"
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300">
                @error('link')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <!-- File Upload Section -->
            <div class="mb-4">
                <label for="photos" class="block text-gray-700">Upload Photos</label>
                <div id="drop-area" class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center bg-gray-100 hover:bg-gray-200 transition">
                    <input type="file" name="photos[]" id="photos" multiple class="hidden" accept="image/*">
                    <p class="text-gray-500">Drag & drop photos here or <span class="text-blue-500 cursor-pointer hover:underline" id="file-select">browse</span></p>
                    <div id="preview" class="mt-4 grid grid-cols-3 gap-2"></div>
                </div>
                @error('photos.*')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Save Event
                </button>
            </div>
        </form>
        <div class="mt-6">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">Back to Events</a>
        </div>
    </div>
    
    <!-- Include Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Include Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    <script>
      // Initialize Quill editor
      var quill = new Quill('#editor', {
          theme: 'snow',
          placeholder: 'Enter description...'
      });
      
      // When the form is submitted, copy the editor content to the hidden input
      function submitEditorContent() {
          var descriptionInput = document.getElementById('description');
          descriptionInput.value = quill.root.innerHTML;
      }
      
      // File upload functionality
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
                      selectedFiles = selectedFiles.filter(f => f !== files[i]);
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
