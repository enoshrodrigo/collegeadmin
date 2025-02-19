<x-app-layout>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Admissions</h1>
      <div>
        <a href="{{ route('admissions.create') }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 transition">
          Apply Now
        </a>
      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
      <!-- Fully Filled Applications -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow">
        <div class="flex-shrink-0">
          <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
          </svg>
        </div>
        <div class="ml-4">
          <p class="text-2xl font-semibold text-gray-700">{{ $fullyFilledCount }}</p>
          <p class="text-sm text-gray-500">Fully Filled Applications</p>
        </div>
      </div>
      <!-- Applications Today -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow">
        <div class="flex-shrink-0">
          <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
          </svg>
        </div>
        <div class="ml-4">
          <p class="text-2xl font-semibold text-gray-700">{{ $todayCount }}</p>
          <p class="text-sm text-gray-500">Applications Today</p>
        </div>
      </div>
      <!-- Total Intakes -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow">
        <div class="flex-shrink-0">
          <svg class="h-12 w-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <!-- Using a group icon; you can change the path if needed -->
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 4a4 4 0 110 8 4 4 0 010-8z" />
          </svg>
        </div>
        <div class="ml-4">
          <p class="text-2xl font-semibold text-gray-700">{{ $intakeCount }}</p>
          <p class="text-sm text-gray-500">Total Intakes</p>
        </div>
      </div>
    </div>

    <!-- Filter Option -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
      <form action="{{ route('admissions.index') }}" method="GET" class="flex flex-wrap items-center space-x-2">
        <label for="filter_intake" class="text-gray-700 font-medium">Filter by Intake:</label>
        <select id="filter_intake" name="intake_id" class="px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300">
          <option value="">All Intakes</option>
          @foreach($intakes as $intake)
            <option value="{{ $intake->id }}" {{ request('intake_id') == $intake->id ? 'selected' : '' }}>{{ $intake->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Filter</button>
      </form>
    </div>

    <!-- Admissions Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIC</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobile</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intake</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($admissions as $admission)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $admission->nic }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $admission->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $admission->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $admission->mobile_no }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $admission->intake ? $admission->intake->name : '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                <a href="{{ route('admissions.edit', $admission->id) }}" class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md hover:bg-yellow-200">Edit</a>
                <form action="{{ route('admissions.destroy', $admission->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure you want to delete this application?')" class="px-3 py-1 bg-red-100 text-red-800 rounded-md hover:bg-red-200">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
      {{ $admissions->links() }}
    </div>
  </div>
</x-app-layout>
