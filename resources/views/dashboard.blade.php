<x-app-layout>
  <div class="container mx-auto p-6">
    <!-- Dashboard Header -->
    <h2 class="text-2xl font-semibold mb-4">Welcome to Mazenod College Dashboard</h2>
    
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <!-- Total News Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- Newspaper Icon -->
          <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7v4M5 7v4m2 0v6a2 2 0 002 2h6a2 2 0 002-2v-6m2-4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">TotalCollege News</h3>
          <p class="text-2xl font-bold">{{ $totalNews }}</p>
        </div>
      </div>
      
      <!-- Total Events Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- Calendar Icon -->
          <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total Events</h3>
          <p class="text-2xl font-bold">{{ $totalEvents }}</p>
        </div>
      </div>
      
      <!-- Total Admissions Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- User Icon -->
          <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M12 12a5 5 0 100-10 5 5 0 000 10z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total Admissions</h3>
          <p class="text-2xl font-bold">{{ $totalAdmissions }}</p>
        </div>
      </div>
      
      <!-- Total Intakes Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- Academic Cap Icon -->
          <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 14l9-5-9-5-9 5 9 5z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total Intakes</h3>
          <p class="text-2xl font-bold">{{ $totalIntakes }}</p>
        </div>
      </div>
    </div>
    
    <!-- Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Latest News Table -->
      <div class="bg-white shadow-lg rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4">College News Latest News</h3>
        <div class="overflow-x-auto">
          <table class="w-full text-left">
            <thead>
              <tr class="border-b bg-gray-50">
                <th class="p-3">Title</th>
                <th class="p-3">Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($latestNews as $news)
                <tr class="border-b hover:bg-gray-100">
                  <td class="p-3">{{ $news->title }}</td>
                  <td class="p-3">{{ $news->created_at->format('Y-m-d') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-4">
          {{ $latestNews->onEachSide(1)->links() }}
        </div>
      </div>
      
      <!-- Upcoming Events Table -->
      <div class="bg-white shadow-lg rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4">Events and Photos</h3>
        <div class="overflow-x-auto">
          <table class="w-full text-left">
            <thead>
              <tr class="border-b bg-gray-50">
                <th class="p-3">Event Name</th>
                <th class="p-3">Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($upcomingEvents as $event)
                <tr class="border-b hover:bg-gray-100">
                  <td class="p-3">{{ $event->title }}</td>
                  <td class="p-3">{{ $event->created_at->format('Y-m-d') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-4">
          {{ $upcomingEvents->onEachSide(1)->links() }}
        </div>
      </div>
    </div>
    
    <!-- Admissions & Intakes Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
      <!-- Recent Admissions Table -->
      <div class="bg-white shadow-lg rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4">Recent Admissions</h3>
        <div class="overflow-x-auto">
          <table class="w-full text-left">
            <thead>
              <tr class="border-b bg-gray-50">
                <th class="p-3">Student Name</th>
                <th class="p-3">Admission Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentAdmissions as $admission)
                <tr class="border-b hover:bg-gray-100">
                  <td class="p-3">{{ $admission->name }}</td>
                  <td class="p-3">{{ $admission->created_at->format('Y-m-d') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-4">
          {{ $recentAdmissions->onEachSide(1)->links() }}
        </div>
      </div>
      
      <!-- Intake Batches Table -->
      <div class="bg-white shadow-lg rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4">Intake Batches</h3>
        <div class="overflow-x-auto">
          <table class="w-full text-left">
            <thead>
              <tr class="border-b bg-gray-50">
                <th class="p-3">Intake Name</th>
                <th class="p-3">Start Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($intakeBatches as $intake)
                <tr class="border-b hover:bg-gray-100">
                  <td class="p-3">{{ $intake->name }}</td>
                  <td class="p-3">{{ $intake->date }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-4">
          {{ $intakeBatches->onEachSide(1)->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
