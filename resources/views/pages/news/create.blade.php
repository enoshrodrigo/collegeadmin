<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Create News</h1>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" 
              x-data="{
                  action: 'link',
                  imagePreview: null,
                  handleDrop(event) {
                      event.preventDefault();
                      const files = event.dataTransfer.files;
                      if(files.length){
                          // Set file input value and preview from dropped file
                          this.$refs.fileInput.files = files;
                          this.imagePreview = URL.createObjectURL(files[0]);
                      }
                  },
                  handleDragOver(event) {
                      event.preventDefault();
                  },
                  init() {
                      // Watch for action change to more_info and force reflow for Quill
                      $watch('action', value => {
                          if(value === 'more_info'){
                              setTimeout(() => {
                                  window.dispatchEvent(new Event('resize'));
                              }, 100);
                          }
                      });
                  }
              }">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Image Upload with Drag & Drop -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Upload Image</label>
                <div class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center bg-gray-100 hover:bg-gray-200 transition"
                     @dragover="handleDragOver" @drop="handleDrop">
                    <input type="file" name="image" id="image" class="hidden" accept="image/*" 
                           x-ref="fileInput" 
                           @change="if ($refs.fileInput.files.length) { imagePreview = URL.createObjectURL($refs.fileInput.files[0]); }">
                    <p class="text-gray-500">
                        <span class="text-blue-500 cursor-pointer hover:underline" 
                              @click="$refs.fileInput.click()">browse</span>
                    </p>
                    <div class="mt-4" x-show="imagePreview">
                        <img :src="imagePreview" class="w-40 h-40 object-cover mx-auto rounded-md">
                        <button type="button" class="mt-2 text-red-600 hover:underline" 
                                @click="imagePreview = null; $refs.fileInput.value = ''">
                            Remove
                        </button>
                    </div>
                </div>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description (Plain Textarea) -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" 
                          class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Button Text -->
            <div class="mb-4">
                <label for="button_text" class="block text-gray-700">Button Text</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('button_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Action Type -->
            <div class="mb-4">
                <span class="block text-gray-700">Action Type</span>
                <label class="inline-flex items-center mt-1">
                    <input type="radio" class="form-radio" name="action" value="link" x-model="action">
                    <span class="ml-2">Link</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" class="form-radio" name="action" value="more_info" x-model="action">
                    <span class="ml-2">More Info</span>
                </label>
                @error('action') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Link Input -->
            <div class="mb-4" x-show="action === 'link'">
                <label for="action_link" class="block text-gray-700">Action Link (URL)</label>
                <input type="url" name="action_link" id="action_link" value="{{ old('action_link') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300">
                @error('action_link') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- More Info with Quill Editor -->
            <div class="mb-4" x-show="action === 'more_info'">
                <label for="more_info" class="block text-gray-700">More Info</label>
                <div id="more-info-editor" class="mt-1 block w-full rounded-md border border-gray-300 
                     px-3 py-2 focus:ring focus:ring-blue-300">
                    {!! old('more_info') !!}
                </div>
                <input type="hidden" name="more_info" id="hidden-more-info" value="{{ old('more_info') }}">
                @error('more_info') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save News
                </button>
            </div>
        </form>
        <div class="mt-8">
            <a href="{{ route('news.index') }}" class="text-blue-600 hover:underline">
                Back to News
            </a>
        </div>
    </div>

    <!-- Include Quill Editor CSS and JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <!-- Alpine.js for toggling action fields -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize Quill editor for the More Info field only
            var moreInfoQuill = new Quill('#more-info-editor', {
                theme: 'snow',
                placeholder: 'Write more info here...'
            });

            // Update the hidden input on every text change so it stays in sync
            moreInfoQuill.on('text-change', function() {
                document.getElementById('hidden-more-info').value = moreInfoQuill.root.innerHTML;
            });

            // Also update the hidden input on form submission
            var form = document.querySelector("form");
            form.addEventListener("submit", function () {
                var actionValue = document.querySelector('input[name="action"]:checked').value;
                if (actionValue === 'more_info') {
                    document.getElementById('hidden-more-info').value = moreInfoQuill.root.innerHTML;
                }
            });
        });
    </script>
</x-app-layout>
