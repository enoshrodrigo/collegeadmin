<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
      <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Intakes</h1>
        <div>
          <a href="{{ route('intakes.create') }}"
             class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-md font-medium hover:bg-green-700 transition">
            Add Intake
          </a>
        </div>
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
                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $intake->date}}</td>
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
    </div>
  </x-app-layout>
  