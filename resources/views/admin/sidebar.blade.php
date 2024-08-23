<div class="sidebar">
  <div class="logo-section">
      <img src="{{asset('images/maxi3.png')}}" alt="Maxi Health Logo" class="sidebar-logo">
  </div>
  <nav class="sidebar-nav">

    <ul>
        <li><a href="{{ route('admin.home') }}" class="{{ Request::routeIs('admin.home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Home</a></li>
        <li><a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Users</a></li>
        <li><a href="{{ route('admin.sales-report') }}" class="{{ Request::routeIs('admin.sales-report') ? 'active' : '' }}"><i class="fa-solid fa-chart-line"></i> Sales Report</a></li>
        <li><a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>           

  </nav>
</div>