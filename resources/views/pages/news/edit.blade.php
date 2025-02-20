<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit News</h1>

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
              x-data="{
                  action: '{{ $news->action }}',
                  imagePreview: '{{ asset('storage/' . $news->image) }}',
                  handleDrop(event) {
                      event.preventDefault();
                      const files = event.dataTransfer.files;
                      if (files.length) {
                          this.$refs.fileInput.files = files;
                          this.imagePreview = URL.createObjectURL(files[0]);
                      }
                  },
                  handleDragOver(event) {
                      event.preventDefault();
                  },
                  init() {
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
            @method('PUT')

            <!-- Hidden input to submit the toggle value -->
            <input type="hidden" name="action" x-model="action">

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Upload with Drag & Drop -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image</label>
                <div class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center bg-gray-100 hover:bg-gray-200 transition"
                     @dragover="handleDragOver" @drop="handleDrop">
                    <input type="file" name="image" id="image" class="hidden" accept="image/*"
                           x-ref="fileInput" 
                           @change="if ($refs.fileInput.files.length) { imagePreview = URL.createObjectURL($refs.fileInput.files[0]); }">
                    <p class="text-gray-500">
                        <span class="text-blue-500  " >Drag and Drop Here</span>
                    </p>
                    <div class="mt-4" x-show="imagePreview">
                        <img :src="imagePreview" class="w-40 h-40 object-cover mx-auto rounded-md">
                        <button type="button" class="mt-2 text-red-600 hover:underline"
                                @click="imagePreview = null; $refs.fileInput.value = ''">
                            Remove
                        </button>
                    </div>
                </div>
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description (Plain Textarea) -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('description', $news->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Button Text -->
            <div class="mb-4">
                <label for="button_text" class="block text-gray-700">Button Text</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $news->button_text) }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('button_text')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Type Toggle -->
            <div class="mb-4">
                <span class="block text-gray-700 mb-2">Action Type</span>
                <div class="flex items-center">
                    <!-- Toggle Switch -->
                    <div class="relative inline-block w-16 h-8 cursor-pointer rounded-full transition-colors duration-200" 
                         :class="{'bg-blue-600': action === 'more_info', 'bg-gray-300': action === 'link'}"
                         @click="action = (action === 'link') ? 'more_info' : 'link'">
                        <span class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full shadow transform transition-transform duration-200"
                              :class="{'translate-x-8': action === 'more_info', 'translate-x-0': action === 'link'}"></span>
                    </div>
                    <span class="ml-3 text-gray-700 font-medium" x-text="action === 'link' ? 'Link' : 'More Info'"></span>
                </div>
            </div>

            <!-- Link Input (Shown if "Link" is selected) -->
            <div class="mb-4" x-show="action === 'link'">
                <label for="action_link" class="block text-gray-700">Action Link (URL)</label>
                <input type="url" name="action_link" id="action_link" value="{{ old('action_link', $news->action_link) }}"
                    class="mt-1 block w-full rounded-md border-gray-300">
                @error('action_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- More Info with Quill Editor (Shown if "More Info" is selected) -->
            <div class="mb-4" x-show="action === 'more_info'">
                <label for="more_info" class="block text-gray-700">More Info</label>
                <div id="more-info-editor" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-300" style="height: 400px;">
                    {!! old('more_info', $news->more_info) !!}
                </div>
                <input type="hidden" name="more_info" id="hidden-more-info" value="{{ old('more_info', $news->more_info) }}">
                @error('more_info')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update News
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
            // Initialize Quill editor for the More Info field
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
                if(document.querySelector('input[name="action"]:checked')?.value === 'more_info' || this.action === 'more_info'){
                    document.getElementById('hidden-more-info').value = moreInfoQuill.root.innerHTML;
                }
            });
        });
    </script>
</x-app-layout>
