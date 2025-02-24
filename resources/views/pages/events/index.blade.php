<x-app-layout>
    <div class="  mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white shadow rounded-lg  m-auto ">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Events Gallery</h1>
            <a href="{{ route('events.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-wider hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Add Event
            </a>
        </div>

        <!-- Success Message tempory -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
                {{ session('success') }}
            </div>
        @endif

   <!-- Statistics Cards -->
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6 ">
    <!-- Total Events -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow">
      <div class="flex-shrink-0">
        <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
      </div>
      <div class="ml-4">
        <p class="text-2xl font-semibold text-gray-700">{{ $totalEvents }}</p>
        <p class="text-sm text-gray-500">Total Events</p>
      </div>
    </div>
    <!-- Active Events -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow">
      <div class="flex-shrink-0">
        <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      <div class="ml-4">
        <p class="text-2xl font-semibold text-gray-700">{{ $activeEvents }}</p>
        <p class="text-sm text-gray-500">Active Events</p>
      </div>
    </div>
    <!-- Offline Events -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow">
      <div class="flex-shrink-0">
        <svg class="h-12 w-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 00-7.07 17.07A10 10 0 0012 22a10 10 0 007.07-2.93A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16zm0-14a6 6 0 100 12 6 6 0 000-12z" />
        </svg>
      </div>
      <div class="ml-4">
        <p class="text-2xl font-semibold text-gray-700">{{ $inactiveEvents }}</p>
        <p class="text-sm text-gray-500">Inactive Events</p>
      </div>
    </div>
</div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <!-- Use first photo as thumbnail if available -->
                    @if($event->photos->first())
                        <img src="{{ asset('storage/' . $event->photos->first()->photo) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-4 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $event->title }}</h2>
                        <div class="mt-1text-gray-600 mb-2 line-clamp-3">{!! $event->description !!}</div>
                   
                      
                        @if($event->link)
                            <a href="{{ $event->link }}" target="_blank" class="text-blue-600 hover:underline mb-4">
                                View More Photos
                            </a>
                        @endif
                        <div class="mt-auto border-t pt-4">
                            <div class="text-gray-600 mb-4">
                                <span class="font-semibold">Date:</span> {{ $event->date }} <span class="px-2 py-1 text-sm rounded-full {{ $event->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $event->status ? 'Active' : 'Inactive' }}
                                </span>
                              </div>  
                            <div class="flex space-x-4 ">
                                
                                <a href="{{ route('events.show', $event->id) }}"
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-green-100 text-yellow-800 rounded-md hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                    View
                                </a>
                                <a href="{{ route('events.edit', $event->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-md hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                     Edit
                                 </a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-100 text-red-800 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                        Delete
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
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
