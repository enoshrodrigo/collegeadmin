<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Admission</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admissions.update', $admission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- NIC -->
                <div class="mb-4">
                    <label for="nic" class="block text-gray-600">NIC</label>
                    <input type="text" id="nic" name="nic" value="{{ old('nic', $admission->nic) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Date of Birth -->
                <div class="mb-4">
                    <label for="dob" class="block text-gray-600">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="{{ old('dob', $admission->dob) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-600">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admission->name) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admission->email) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Mobile Number -->
                <div class="mb-4">
                    <label for="mobile_no" class="block text-gray-600">Mobile Number</label>
                    <input type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $admission->mobile_no) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Intake Dropdown -->
                <div class="mb-4">
                    <label for="intake_id" class="block text-gray-600">Select Intake</label>
                    @if($activeIntakes->isEmpty())
                        <p class="text-red-500 text-sm mt-1">Currently, our registrations are closed.</p>
                    @else
                        <select id="intake_id" name="intake_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                            <option value="">-- Select Intake --</option>
                            @foreach($activeIntakes as $intake)
                                <option value="{{ $intake->id }}" {{ old('intake_id', $admission->intake_id) == $intake->id ? 'selected' : '' }}>
                                    {{ $intake->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('intake_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    @endif
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admissions.index') }}" class="px-4 py-2 text-gray-600 border rounded-lg mr-2 hover:bg-gray-100">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Admission</button>
                </div>
            </form>
        </div>
        <div class="mt-6">
            <a href="{{ route('admissions.index') }}" class="text-blue-600 hover:underline">Back to Admissions</a>
        </div>
    </div>
</x-app-layout>
