<div class="sidebar">
  <div class="logo-section">
      <img src="{{asset('images/maxi3.png')}}" alt="Maxi Health Logo" class="sidebar-logo">
  </div>
  <nav class="sidebar-nav">
    <ul>
      <li><a href="{{ route('staff.home') }}" class="{{ request()->routeIs('staff.home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Home</a></li>
      <li><a href="{{ route('staff.stock') }}" class="{{ request()->routeIs('staff.stock') ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-bars"></i> Stock Monitoring</a></li>
      <li><a href="{{ route('staff.sales') }}" class="{{ request()->routeIs('staff.sales') ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-coins"></i> Sales</a></li>
      <li><a href="{{ route('staff.receiving') }}" class="{{ request()->routeIs('staff.receiving') ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-download"></i> Receiving</a></li>
      <li><a href="{{ route('staff.product-category') }}" class="{{ request()->routeIs('staff.product-category') ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-bars"></i> Product Category</a></li>
      <li><a href="{{ route('staff.product-list') }}" class="{{ request()->routeIs('staff.product-list') ? 'active' : '' }}"><i class="fa-solid fa-box"></i> Product List</a></li>
      <li><a href="{{ route('staff.expired-list') }}" class="{{ request()->routeIs('staff.expired-list') ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-bars"></i> Expired List</a></li>
      <li><a href="{{ route('staff.supplier-list') }}" class="{{ request()->routeIs('staff.supplier-list') ? 'active' : '' }}"><i class="fa-solid fa-person-chalkboard"></i> Supplier List</a></li>
      <li><a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
  </nav>
</div>