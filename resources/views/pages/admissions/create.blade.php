<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }} - Admission</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css'])
  </head>
  <body class="bg-gradient-to-r from-blue-50 to-white min-h-screen">
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

  <div class="max-w-md w-full space-y-8">
    <div class="text-center">
      <img src="https://mazenodcollege.lk/wp-content/uploads/2023/02/Mazenod-College-High-res-2.png" alt="Mazenod College Logo" class="mx-auto h-16 mb-4">
      <h1 class="text-4xl font-extrabold text-gray-900">Admission Form</h1>
      <p class="mt-2 text-sm text-gray-600">Fill in your details to apply for admission.</p>
    </div>
    @if(session('success'))
      <div class="p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 mt-6">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ route('admissions.store') }}" method="POST" class="mt-8 space-y-6 bg-white p-6 rounded-lg shadow-lg">
      @csrf
      <div class="mb-4">
        <label for="nic" class="block text-gray-700 font-medium">NIC</label>
        <input id="nic" name="nic" type="text" value="{{ old('nic') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-blue-500" placeholder="Your NIC" />
        @error('nic')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
      </div>
      <div class="mb-4">
        <label for="dob" class="block text-gray-700 font-medium">Date of Birth</label>
        <input id="dob" name="dob" type="date" value="{{ old('dob') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-blue-500" />
        @error('dob')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
      </div>
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-medium">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-blue-500" placeholder="Your full name" />
        @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-blue-500" placeholder="you@example.com" />
        @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
      </div>
      <div class="mb-4">
        <label for="mobile_no" class="block text-gray-700 font-medium">Mobile Number</label>
        <input id="mobile_no" name="mobile_no" type="text" value="{{ old('mobile_no') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-blue-500" placeholder="+1 234 567 890" />
        @error('mobile_no')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
      </div>
      <div class="mb-4">
        <label for="intake_id" class="block text-gray-700 font-medium">Select Intake</label>
    
        @if($activeIntakes->isEmpty())
            <p class="text-red-500 text-sm mt-1">Currently, our registrations are closed.</p>
        @else
            <select id="intake_id" name="intake_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-blue-500">
                <option value="">-- Select Intake --</option>
                @foreach($activeIntakes as $intake)
                    <option value="{{ $intake->id }}" {{ old('intake_id') == $intake->id ? 'selected' : '' }}>
                        {{ $intake->name }}
                    </option>
                @endforeach
            </select>
            @error('intake_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        @endif
    </div>
    
      <!-- reCAPTCHA -->
      <div class="mb-4 pt-4">
        {!! NoCaptcha::display() !!}
        @error('g-recaptcha-response')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
      </div>
      <div>
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
          Submit Admission
        </button>
      </div>
    </form>
  </div>
  {!! NoCaptcha::renderJs() !!} 
</div>

 </body>
</html>
