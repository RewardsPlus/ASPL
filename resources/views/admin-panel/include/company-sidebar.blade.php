<div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{env('Logo_Path')}}" alt=""></a>
        <div class="back-btn"><i data-feather="grid"></i></div>
        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="index.html">
          <div class="icon-box-sidebar"><i data-feather="grid"></i></div></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="javascript::void(0)"><i data-feather="airplay"></i><span >Employee</span></a>
                <ul class="sidebar-submenu" style="display:block">
                  <li><a href="{{ route(Helper::getGuard().'.employee.index') }}">All Employee</a></li>
                  <li><a href="{{ route(Helper::getGuard().'.attendance.index') }}">Attendance</a></li>
                  <li><a class="" href="{{ route(Helper::getGuard().'.employee.leave.application') }}">Leave Application</a></li> 
                </ul>
              </li>
              
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="lock"></i><span >Role & Permission</span></a>
                <ul class="sidebar-submenu" style="display:block">
                  <li><a  href="{{route(Helper::getGuard().'.role-permission.role.index')}}" >Role </a></li>
                  <li><a  href="{{route(Helper::getGuard().'.role-permission.permission.index')}}" >Permission </a></li>
                  <li><a  href="{{route(Helper::getGuard().'.role-permission.role-has-permission')}}" >Role Has Permission </a></li>
                  {{-- <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li> --}}
                </ul>
              </li>
              {{-- Delivery management --}}
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="javascript::void(0)"><i data-feather="airplay"></i><span >Delivery</span></a>
                <ul class="sidebar-submenu" style="display:block">
                  <li><a href="{{ route(Helper::getGuard().'.delivery.pincode') }}">Locations</a></li>
                </ul>
              </li>
              {{-- QR Code --}}
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="javascript::void(0)"><i data-feather="airplay"></i><span >QR Code</span></a>
                <ul class="sidebar-submenu" style="display:block">
                  <li><a href="{{ route('qrcodes.create') }}">create</a></li>
                  <li><a href="{{ route('qrcodes.index') }}">List</a></li>
                </ul> 
              </li>
        </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
