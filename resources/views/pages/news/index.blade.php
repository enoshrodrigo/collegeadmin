<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-4 py-8 bg-white shadow rounded-lg  m-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 text">News Management</h1>
            <a href="{{ route('news.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-wider hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add News
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
                {{ session('success') }}
            </div>
        @endif
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <!-- Total News -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow">
        <div class="flex-shrink-0">
            <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7v4M5 7v4m2 0v6a2 2 0 002 2h6a2 2 0 002-2v-6m2-4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" />
            </svg>
        </div>
        <div class="ml-4">
            <p class="text-2xl font-semibold text-gray-700">{{ $totalNews }}</p>
            <p class="text-sm text-gray-500">Total News</p>
        </div>
    </div>
    <!-- Active News -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow">
        <div class="flex-shrink-0">
            <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div class="ml-4">
            <p class="text-2xl font-semibold text-gray-700">{{ $activeNews }}</p>
            <p class="text-sm text-gray-500">Active News</p>
        </div>
    </div>
    <!-- Archived News -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow">
        <div class="flex-shrink-0">
            <svg class="h-12 w-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 00-7.07 17.07A10 10 0 0012 22a10 10 0 007.07-2.93A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16zm0-14a6 6 0 100 12 6 6 0 000-12z" />
            </svg>
        </div>
        <div class="ml-4">
            <p class="text-2xl font-semibold text-gray-700">{{ $inactiveNews }}</p>
            <p class="text-sm text-gray-500">Inactive News</p>
        </div>
    </div>
</div>
        <!-- News Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                    <div class=" p-2.5 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">{{ $item->title }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-1">{{ $item->description }}</p>
                        
                        <!-- Main Action Button -->
                        <div class="mb-4">
                            @if($item->action === 'link')
                                <a href="{{ $item->action_link }}" target="_blank"
                                   class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        <span>{{ $item->button_text }}</span>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('news.show', $item->id) }}"  target="_blank"
                                   class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $item->button_text }}</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                        
                        <!-- Footer Buttons -->
                        <div class="mt-auto border-t pt-4">
                            <div class="text-gray-600 mb-4">
                                <span class="font-semibold">Date:</span> {{ $item->date }} <span class="px-2 py-1 text-sm rounded-full {{ $item->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                </span>
                              </div>  
                            <div class="flex space-x-4">
                                <a href="{{ route('news.edit', $item->id) }}"
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-md hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                    <span>Edit</span>
                                </a>
                                
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-100 text-red-800 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
                                        onclick="return confirm('Are you sure you want to delete this news?')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $news->links() }}
        </div>
    </div>
    <script>
        fetch('http://localhost:8000/api/events', {
            method: 'POST', 
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
      </script>
      
</x-app-layout>
