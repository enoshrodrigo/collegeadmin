<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Create New Intake</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('intakes.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-600">Intake Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <div class="mb-4">
                    <label for="start_date" class="block text-gray-600">Date</label>
                    <input type="date" id="start_date" name="date" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                {{-- <div class="mb-4">
                    <label for="end_date" class="block text-gray-600">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div> --}}

                <div class="mb-4">
                    <label for="status" class="block text-gray-600">Status</label>
                    <select id="status" name="registration_enabled" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('intakes.index') }}" class="px-4 py-2 text-gray-600 border rounded-lg mr-2 hover:bg-gray-100">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
        <div class="mt-6">
            <a href="{{ route('intakes.index') }}" class="text-blue-600 hover:underline">Back to Intakes</a>
        </div>
    </div>
</x-app-layout>
