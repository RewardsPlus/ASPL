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
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-list">
              <h6>Pinned</h6>
            </li>
            <hr>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="javascript:void(0)"><i data-feather="home"></i><span >Analytics</span></a>
              <ul class="sidebar-submenu" style="display:block">
                <li><a @if(Route::has(Helper::getGuard().'.dashboard')) href="{{route(Helper::getGuard().'.dashboard')}}" @endif>Store Analytics </a></li>
                {{-- <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li> --}}
              </ul>
            </li>


            {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="support-ticket.html"><i data-feather="users"> </i><span>Support Ticket</span></a></li>

             <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li> --}}
            <li class="pin-title sidebar-list">
              <h6>Pinned</h6>
            </li>
            <hr>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="lock"></i><span >Role & Permission</span></a>
              <ul class="sidebar-submenu" style="display:block">
                <li><a  href="{{route(Helper::getGuard().'.role-permission.role.index')}}" >Role </a></li>
                {{-- <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li> --}}
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="lock"></i><span >Company</span></a>
                <ul class="sidebar-submenu" style="display:block">
                  <li><a  href="{{route(Helper::getGuard().'.company.index')}}" >Companies</a></li>
                  <li><a  href="{{route(Helper::getGuard().'.store.index')}}" >Stores</a></li>
                  <li><a  href="{{route(Helper::getGuard().'.company.employee')}}" >Employee</a></li>
                  <li><a  href="{{route(Helper::getGuard().'.company.employee-attendance')}}" >Attendance</a></li>
                  {{-- <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li> --}}
                </ul>
              </li>
              {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="support-ticket.html"><i data-feather="users"> </i><span>Employee</span></a></li> --}}
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
