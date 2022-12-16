@php 
  use App\Models\AppSettings;
  $settings = AppSettings::first();

  use App\Models\Admin;
  $admin_id = Auth::guard('admin')->id();
	$admin = Admin::where('id', $admin_id)->first();

@endphp
<div class="navbar-custom">
  <ul class="list-unstyled topnav-menu float-end mb-0">
    <li class="dropdown notification-list topbar-dropdown"> 
      <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
        href="#" role="button" aria-haspopup="false" aria-expanded="false"> 
        @if($admin->image)
          <img src="{{ asset('/storage/settings/'.$admin->image)}}" class="rounded-circle">
        @else
          <img src="{{ asset('assets/admin/images/users/user-1.jpg')}}" class="rounded-circle">
        @endif

        <span class="pro-user-name ms-1"> {{ $admin->name ?  $admin->name : Admin }} <i class="mdi mdi-chevron-down"></i> </span> 
      </a>
      <div class="dropdown-menu dropdown-menu-end profile-dropdown "> 
        <!-- item-->
        <div class="dropdown-header noti-title">
          <h6 class="text-overflow m-0">Welcome !</h6>
        </div>
        <a href="{{ route('admin-adminsettings')}}" class="dropdown-item notify-item"> <i class="fe-user"></i> <span>My Account</span> </a> 
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin-logout')}}" class="dropdown-item notify-item"> <i class="fe-log-out"></i> <span>Logout</span> </a> </div>
    </li>
  </ul>
  
  <!-- LOGO -->
  <div class="logo-box"> 
    @if($settings->logo)
      <a href="{{ route('admin-dashboard') }}" class="logo logo-light text-center"> 
        <span class="logo-sm"> <img src="{{ asset('/storage/settings/'.$settings->logo)}}" alt="" height="22"> </span> 
        <span class="logo-lg"> <img src="{{ asset('/storage/settings/'.$settings->logo)}}" alt="" height="45"> </span> 
      </a>
      <a href="{{ route('admin-dashboard') }}" class="logo logo-dark text-center"> 
        <span class="logo-sm"> <img src="{{ asset('/storage/settings/'.$settings->logo)}}" alt="" height="22"> </span> 
        <span class="logo-lg"> <img src="{{ asset('/storage/settings/'.$settings->logo)}}" alt="" height="45"> </span> 
      </a> 
    @else 
      <a href="{{ route('admin-dashboard') }}" class="logo logo-light text-center"> 
        <span class="logo-sm"> <img src="{{ asset('assets/admin/images/logo-sm.png')}}" alt="" height="22"> </span> 
        <span class="logo-lg"> <img src="{{ asset('assets/admin/images/logo-dark.png')}}" alt="" height="16"> </span> 
      </a>
      <a href="{{ route('admin-dashboard') }}" class="logo logo-dark text-center"> 
        <span class="logo-sm"> <img src="{{ asset('assets/admin/images/logo-sm.png')}}" alt="" height="22"> </span> 
        <span class="logo-lg"> <img src="{{ asset('assets/admin/images/logo-dark.png')}}" alt="" height="16"> </span> 
      </a>
    @endif
  </div>

  <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
    <li>
      <button class="button-menu-mobile disable-btn waves-effect"> <i class="fe-menu"></i> </button>
    </li>
    <li>
      <h4 class="page-title-main">{{ $page_title }}</h4>
    </li>
  </ul>
  <div class="clearfix"></div>
</div>
