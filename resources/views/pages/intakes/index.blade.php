<x-app-layout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white shadow rounded-lg">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Intakes</h1>
      <div>
        <a href="{{ route('intakes.create') }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-md font-medium hover:bg-green-700 transition">
          Add Intake
        </a>
      </div>
    </div>

    @if (session('success'))
      <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        {{ session('error') }}
      </div>
    @endif

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
  <!-- Total Intakes -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow">
    <div class="flex-shrink-0">
      <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 3V4l3 3h4M13 10h4l3 3V4l3 3h4M3 20h4l3 3V14l3 3h4M13 20h4l3 3V14l3 3h4" />
      </svg>
    </div>
    <div class="ml-4">
      <p class="text-2xl font-semibold text-gray-700">{{ $totalIntakes }}</p>
      <p class="text-sm text-gray-500">Total Intakes</p>
    </div>
  </div>
  <!-- Active Intakes -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow">
    <div class="flex-shrink-0">
      <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
    </div>
    <div class="ml-4">
      <p class="text-2xl font-semibold text-gray-700">{{ $activeIntakes }}</p>
      <p class="text-sm text-gray-500">Active Intakes</p>
    </div>
  </div>
  <!-- Inactive Intakes -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow">
    <div class="flex-shrink-0">
      <svg class="h-12 w-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 00-7.07 17.07A10 10 0 0012 22a10 10 0 007.07-2.93A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16zm0-14a6 6 0 100 12 6 6 0 000-12z" />
      </svg>
    </div>
    <div class="ml-4">
      <p class="text-2xl font-semibold text-gray-700">{{ $inactiveIntakes }}</p>
      <p class="text-sm text-gray-500">Inactive Intakes</p>
    </div>
  </div>
</div>

    <!-- Filter Section -->
    <div class="mb-6 p-4 bg-gray-50 rounded-md">
      <form action="{{ route('intakes.index') }}" method="GET">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
          <!-- Search by Name -->
          <div>
            <label for="search" class="block text-gray-700 font-medium mb-1">Search by Name</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}"
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                   placeholder="Enter name">
          </div>

          <!-- Filter by Status -->
          <div>
            <label for="status" class="block text-gray-700 font-medium mb-1">Filter by Status</label>
            <select id="status" name="status" class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300">
              <option value="">All Statuses</option>
              <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
              <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          <!-- Filter by Date -->
          <div>
            <label for="date" class="block text-gray-700 font-medium mb-1">Filter by Date</label>
            <input type="date" id="date" name="date" value="{{ request('date') }}"
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300">
          </div>
        <!-- Filter & Reset Buttons -->
        </div>
 <div class="mt-4 flex flex-wrap gap-2">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Filter
          </button>
          <a href="{{ route('intakes.index') }}"
             class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
            Reset
          </a>
        </div> 
      
      </form>
    </div>

    <!-- Intakes Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intake Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intake Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($intakes as $intake)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $intake->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $intake->date }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                @if($intake->registration_enabled)
                  <span class="text-green-600 font-semibold">Enabled</span>
                @else
                  <span class="text-red-600 font-semibold">Disabled</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                <a href="{{ route('intakes.edit', $intake->id) }}" class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md hover:bg-yellow-200">Edit</a>
                <form action="{{ route('intakes.destroy', $intake->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Delete this intake?')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md hover:bg-red-200">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mt-6">
      {{ $intakes->links() }}
    </div>
  </div>
</x-app-layout>