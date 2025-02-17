<nav class="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/') }}" class="sidebar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-75">
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
         {{--  <a href="{{ route('upload') }}" class="nav-link"> --}}
            <i class="link-icon" data-feather="upload"></i>
            <span class="link-title">Upload</span>
          </a>
        </li>
        <li class="nav-item">
         {{--  <a href="{{ route('blog') }}" class="nav-link"> --}}
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Blog</span>
          </a>
        </li>
        <li class="nav-item">
         {{--  <a href="{{ route('analytics') }}" class="nav-link"> --}}
            <i class="link-icon" data-feather="bar-chart-2"></i>
            <span class="link-title">Analytics</span>
          </a>
        </li>
        <li class="nav-item">
          {{-- <a href="{{ route('settings') }}" class="nav-link"> --}}
            <i class="link-icon" data-feather="settings"></i>
            <span class="link-title">Settings</span>
          </a>
        </li>
        <li class="nav-item">
          {{-- <a href="{{ route('profile') }}" class="nav-link"> --}}
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">Profile</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  