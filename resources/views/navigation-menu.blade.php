<div x-data="{ sidebarOpen: false }" class="flex h-full bg-gray-100">
  <!-- Mobile off-canvas sidebar -->
  <nav class="sidebar position-relative ">
    <div class="sidebar-header">
      <a href="{{route('dashboard')}}" class="sidebar-brand">
        <img src="https://mazenodcollege.lk/wp-content/uploads/2023/02/Mazenod-College-High-res-2.png" alt="logo" class=" w-16">
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active bg-slate-50' : '' }}">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="home"></i>
            <span class="link-title">{{ __('Dashboard') }}</span>
          </a>
        </li>

        <li class="nav-item {{ request()->routeIs('events.index') ? 'active bg-slate-50' : '' }}">
          <a href="{{ route('events.index') }}" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">{{ __('Add Events') }}</span>
          </a>
        </li>

        <li class="nav-item {{ request()->routeIs('news.index') ? 'active bg-slate-50' : '' }}">
          <a href="{{ route('news.index') }}" class="nav-link">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">{{ __('Add News') }}</span>
          </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admissions.index') ? 'active bg-slate-50' : '' }}">
          <a href="{{ route('admissions.index') }}" class="nav-link">
            <i class="link-icon" data-feather="book-open"></i>
            <span class="link-title">{{ __('Add Admissions') }}</span>
          </a>
        </li>

        <li class="nav-item {{ request()->routeIs('intakes.index') ? 'active bg-slate-50' : '' }}">
          <a href="{{ route('intakes.index') }}" class="nav-link">
            <i class="link-icon" data-feather="user-plus"></i>
            <span class="link-title">{{ __('Add Intakes') }}</span>
          </a>
        </li>

        <li class="nav-item {{ request()->routeIs('intakes.index') ? '' : '' }}">
          <a href="https://calendar.google.com/calendar/u/0/r?pli=1"  target='_blank' class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">{{ __('Add Calender') }}</span>
          </a>
        </li>


        <li class="nav-item" x-data="{ open: false }">
          <button @click="open = !open" class="nav-link">
            <i class="mlink-icon" data-feather="user"></i>
            <span>{{ __('Profile') }}</span>
            <i class="link-title transition-transform duration-200" 
               :class="{ 'rotate-180': open }" 
               data-lucide="chevron-down"></i>
          </button>
          <!-- Removed extra left padding ("pl-8") to align dropdown content with the sidebar -->
          <ul x-show="open" x-collapse class="space-y-1 p-0" x-cloak>
            <!-- Jetstream Profile Photo and Details -->
            <li class="p-3 border-t border-gray-200">
              <div class="flex items-center">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                  <img class="h-10 w-10 rounded-full object-cover" 
                       src="{{ Auth::user()->profile_photo_url }}" 
                       alt="{{ Auth::user()->name }}">
                @endif
                <div class="ml-3">
                  <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                  <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
              </div>
            </li>
  
            <!-- Profile Links -->
            <li>
              <a href="{{ route('profile.show') }}" class="flex items-center p-3 text-gray-700 hover:bg-slate-50">
                <i class="mr-2" data-lucide="settings"></i>
                <span>{{ __('Profile') }}</span>
              </a>
            </li>
  
            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
              <li>
                <a href="{{ route('api-tokens.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-slate-50">
                  <i class="mr-2" data-lucide="key"></i>
                  <span>{{ __('API Tokens') }}</span>
                </a>
              </li>
            @endif
  
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center p-3 text-gray-700 hover:bg-slate-50 text-left">
                  <i class="mr-2" data-lucide="log-out"></i>
                  <span>{{ __('Log Out') }}</span>
                </button>
              </form>
            </li>
  
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
              <li class="mt-3 border-t border-gray-200 pt-3">
                <span class="px-3 text-xs text-gray-400">{{ __('Manage Team') }}</span>
              </li>
              <li>
                <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="flex items-center p-3 text-gray-700 hover:bg-slate-50">
                  <i class="mr-2" data-lucide="settings"></i>
                  <span>{{ __('Team Settings') }}</span>
                </a>
              </li>
              @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <li>
                  <a href="{{ route('teams.create') }}" class="flex items-center p-3 text-gray-700 hover:bg-slate-50">
                    <i class="mr-2" data-lucide="plus-circle"></i>
                    <span>{{ __('Create New Team') }}</span>
                  </a>
                </li>
              @endcan
              @if (Auth::user()->allTeams()->count() > 1)
                <li class="mt-3 border-t border-gray-200 pt-3">
                  <span class="px-3 text-xs text-gray-400">{{ __('Switch Teams') }}</span>
                </li>
                @foreach (Auth::user()->allTeams() as $team)
                  <li>
                    <x-switchable-team :team="$team" component="responsive-nav-link" />
                  </li>
                @endforeach
              @endif
            @endif
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>


                  
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js"></script> 
<script>
  document.addEventListener('DOMContentLoaded', function () {
    lucide.createIcons();
  });
</script>
