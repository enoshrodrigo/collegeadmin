<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mazenod College Admin Panel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
      href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
      rel="stylesheet"
    />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: "Figtree", sans-serif;
      }
    </style>
  </head>
  <!-- Set body to flex-col and min-h-screen so that footer sticks to the bottom -->
  <body class="flex flex-col min-h-screen antialiased bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-4">
        <div class="flex items-center">
          <img src="https://mazenodcollege.lk/wp-content/uploads/2023/02/Mazenod-College-High-res-2.png" alt="Mazenod College Logo" class="w-16 h-auto mr-3" />
          <h1 class="text-2xl font-bold text-gray-800">
            Mazenod College Admin Panel
          </h1>
        </div>
        <div class="space-x-4">
          @if (Route::has('login'))
            @auth
              <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-800 font-semibold">Dashboard</a>
            @else
              <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 font-semibold">Log in</a>
              @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800 font-semibold">Register</a>
              @endif
            @endauth
          @endif
        </div>
      </div>
    </header>

    <!-- Main Content (flex-1 ensures it expands to fill available space) -->
    <main class="flex-1 max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">
          Welcome to Mazenod College Admin Panel
        </h2>
        <p class="mt-4 text-lg text-gray-600">
          Manage events, admissions, intakes, news and more – all in one place.
        </p>
      </div>

      <!-- Options Grid -->
      <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-2">
        <!-- Dashboard Card -->
        <a href="{{ route('dashboard') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition-shadow">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 rounded-full p-3">
              <i data-feather="home" class="w-6 h-6 text-red-500"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-xl font-semibold text-gray-800">Dashboard</h3>
              <p class="mt-2 text-gray-600 text-sm">
                Overview of college operations and key metrics.
              </p>
            </div>
          </div>
        </a>
        <!-- Events Card -->
        <a href="{{ route('events.index') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition-shadow">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 rounded-full p-3">
              <i data-feather="calendar" class="w-6 h-6 text-red-500"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-xl font-semibold text-gray-800">Manage Events</h3>
              <p class="mt-2 text-gray-600 text-sm">
                Create and update college events seamlessly.
              </p>
            </div>
          </div>
        </a>
        <!-- News Card -->
        <a href="{{ route('news.index') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition-shadow">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 rounded-full p-3">
              <i data-feather="file-text" class="w-6 h-6 text-red-500"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-xl font-semibold text-gray-800">News</h3>
              <p class="mt-2 text-gray-600 text-sm">
                Keep the community informed with the latest updates.
              </p>
            </div>
          </div>
        </a>
        <!-- Admissions Card -->
        <a href="{{ route('admissions.index') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition-shadow">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 rounded-full p-3">
              <i data-feather="book-open" class="w-6 h-6 text-red-500"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-xl font-semibold text-gray-800">Admissions</h3>
              <p class="mt-2 text-gray-600 text-sm">
                Review and manage student admissions easily.
              </p>
            </div>
          </div>
        </a>
        <!-- Intakes Card -->
        <a href="{{ route('intakes.index') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition-shadow">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 rounded-full p-3">
              <i data-feather="user-plus" class="w-6 h-6 text-red-500"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-xl font-semibold text-gray-800">Intakes</h3>
              <p class="mt-2 text-gray-600 text-sm">
                Manage student intakes and registration settings.
              </p>
            </div>
          </div>
        </a>
        <!-- Profile Card -->
        <a href="{{ route('profile.show') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition-shadow">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 rounded-full p-3">
              <i data-feather="user" class="w-6 h-6 text-red-500"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-xl font-semibold text-gray-800">Profile</h3>
              <p class="mt-2 text-gray-600 text-sm">
                View and update your profile and account settings.
              </p>
            </div>
          </div>
        </a>
      </div>
    </main>

    <!-- Footer (sticky at the bottom) -->
    <footer class="bg-white">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
        © {{ date('Y') }} Mazenod College. All rights reserved.
      </div>
    </footer>

    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        feather.replace();
      });
    </script>
  </body>
</html>
