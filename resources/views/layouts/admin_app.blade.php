<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('theme/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('theme/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ asset('theme/css/fontastic.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ asset('theme/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{ asset('theme/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('theme/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('theme/css/custom.css') }}">
    <!-- Favicon-->
    <!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="{{ asset('theme/img//users/Ron.png') }}" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">{{ Auth::user()->name }}</h2>
            @if (!empty(Auth::user()->position->title))
              <span>{{ Auth::user()->position->title }}</span>
            @endif            
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>R</strong><strong class="text-primary">T</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li class="{{is_route_active('dashboard')}}">
              <a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Dashboard</a>
            </li>
            @can('department-list')
              <li class="{{is_route_active('departments')}}">
                <a href="{{ route('departments.index') }}"> <i class="fa fa-bar-chart"></i>Departments</a>
              </li>
            @endcan

            @can('position-list')
              <li class="{{is_route_active('positions')}}">
                <a href="{{ route('positions.index') }}"> <i class="icon-grid"></i>Positions</a>
              </li>
            @endcan

            <li class="{{is_route_active('timesheets')}}">
              @can('timesheet-summary')
                <a href="{{ route('timesheets.index') }}"> <i class="icon-grid"></i>Timesheets</a>
              @else                
                <a href="{{ route('timesheets.show', Auth::user()->id) }}"> <i class="icon-grid"></i>Timesheets</a>
              @endcan
            </li>

            @role('admin')
              <li class="{{is_route_active('shifts')}}">
                <a href="{{ route('shifts.index') }}"> <i class="icon-user"></i>Shifts</a>
              </li>
              <li class="{{is_route_active('leave-types')}}">
                <a href="{{ route('leave-types.index') }}"> <i class="icon-user"></i>Leave Types</a>
              </li>
              <li class="{{is_route_active('remotes')}}">
                <a href="{{ route('remotes.index') }}"> <i class="icon-user"></i>Remote Details</a>
              </li>
              <li class="{{is_route_active('users')}}">
                <a href="{{ route('users.index') }}"> <i class="icon-user"></i>Users</a>
              </li>
              <li class="{{is_route_active('roles')}}">
                <a href="{{ route('roles.index') }}"> <i class="icon-grid"></i>Roles</a>
              </li>
            @endrole

          </ul>
        </div>


        <div class="admin-menu">
          <h5 class="sidenav-heading">Sample menu</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
            <li>
              <a href="#">
                <i class="icon-mail"></i>Demo
                <div class="badge badge-warning">6 New</div>
              </a>
            </li>
            <li>
              <a href="#"><i class="icon-flask"></i>Demo
                <div class="badge badge-info">Special</div>
              </a>
            </li>
          </ul>
        </div>
      </div>


      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Admin </span><strong class="text-primary">{{ config('app.name') }}</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications dropdown-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li>
                      <a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">
                        <strong> <i class="fa fa-bell"></i> View all notifications</strong>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- Settings -->
                <li class="nav-item dropdown">
                  <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                       <i class="fa fa-cogs"></i> Settings
                  </a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li class="text-center">
                      <a rel="nofollow" href="{{ route('logout') }}" class="dropdown-item" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">                                        
                         <i class="fa fa-sign-out"></i><span class="">Logout</span>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                  </ul>
                </li>
               
              </ul>
            </div>
          </div>
        </nav>
      </header>      

       <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Tables       </li>
          </ul>
        </div>
      </div>

      <!-- Content Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          @yield('content')
        </div>
      </section>
      <!-- Content Section - End -->

      
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Your company &copy; 2017-2019</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('theme/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('theme/js/charts-home.js') }}"></script>
    <!-- Main File-->
    <script src="{{ asset('theme/js/front.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>