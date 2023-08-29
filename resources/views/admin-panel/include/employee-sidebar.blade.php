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
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="javascript:voud(0)"><i data-feather="airplay"></i><span >Attendance</span></a>
            
                <ul class="sidebar-submenu" style="display:block">
                  <li><a href="{{ route(Helper::getGuard().'.attendance.index') }}">Attendance</a></li>
                  @if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance',App\Models\PermissionName::$employee))
                  <li ><a class="active" href="{{ route(Helper::getGuard().'.attendance.employee-list') }}"><span >Bulk Attendance</span></a>
                @endif
                </ul>
              </li>
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="{{ route(Helper::getGuard().'.leave.index') }}"><i data-feather="airplay"></i><span >Leave</span></a>
              </li>
        </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
