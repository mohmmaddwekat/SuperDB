<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ APP::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/layout-assets/img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->

    @if (APP::isLocale('ar'))
        <link rel="stylesheet" href="/layout-assets/css/style-rtl.css">
    @else   
        <link rel="stylesheet" href="/layout-assets/css/style.css">
    @endif
    

    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
</head>

<body class="bg-light  bg-gradient">
    <div class="layer"></div>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        @php
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
             
    @endphp
    <aside class="sidebar">
      <div class="sidebar-start">
          <div class="sidebar-head">
              <a href="{{ route('super-db.dashboard') }}" class="logo-wrapper" title="Home">
                  <span class="icon logo" aria-hidden="true"></span>
                  <div class="logo-text">
                      <span class="logo-title glitch" data-text=" Super DB">Super DB</span>
                      <span class="logo-subtitle">{{ __($title) }}</span>
                  </div>
  
              </a>
            
              <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                  <span class="sr-only">Toggle menu</span>
                  <span class="icon menu-toggle" aria-hidden="true"></span>
              </button>
          </div>
          <div class="sidebar-body">
              <ul class="sidebar-body-menu">
  
  
                  <li>
                      <a class="@if (Request::is('dashboard')) active @endif" href="{{ route('super-db.dashboard') }}"><span
                          class="icon home" aria-hidden="true"></span>{{ __('Dashboard') }}</a>
                  </li>
  
                  <li>
                      <a class="@if (Request::is('connection')) active @endif" href="{{ route('super-db.connection.index') }}"><span
                          class="icon setting" aria-hidden="true"></span>{{ __('Connection') }}</a>
                  </li>
                  <li>
                      <ul class="cat-sub-menu">
                      </ul>
                  </li>
  
                  
                  @if (in_array('users.register',$roles_permissions) || in_array('super-db.roles.index',$roles_permissions))
                  <span class="system-menu__title">{{ __('system control') }}</span>
                  <li>
                      <a class="show-cat-btn @if (Request::is('register'))  || (Request::is('roles')) active @endif " href="##" >
                          <span class="icon user-3" aria-hidden="true"></span>{{ __('Admin') }}
                          <span class="category__btn transparent-btn" title="Open list">
                              <span class="sr-only">{{ __('Open list') }}</span>
                              <span class="icon arrow-down" aria-hidden="true"></span>
                          </span>
                      </a>
                      <ul class="cat-sub-menu">
                          @if (in_array('users.register',$roles_permissions))
                          <li>
                              <a href="{{ route('users.register') }}" >{{ __('Create Users') }}</a>
                          </li>
                          @endif
                          @if (in_array('super-db.roles.index',$roles_permissions))
                          <li>
                              <a href="{{ route('super-db.roles.index') }}">{{ __('Create Roles') }}</a>
                          </li>
                          @endif
                      </ul>
                  </li>
                  @endif
  
             
              </ul>
          </div>
      </div>
      <div class="sidebar-footer">
          <a href="" class="sidebar-user">
  
              <div class="sidebar-user-info">
                  <span class="sidebar-user__title">{{ Auth::user()->fullname }}</span>
                  <span class="sidebar-user__subtitle">{{ Auth::user()->type }}</span>
              </div>
            </a>

            <div>
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (!session()->has('locale')) {{ __('English') }} @endif
                    @if (session()->get('locale') == 'en') {{ __('English') }} @endif
                    @if (session()->get('locale') == 'ar') {{ __('Arabic') }} @endif
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ route('super-db.locale', 'en') }}">{{ __('English') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('super-db.locale', 'ar') }}">{{ __('Arabic') }}</a></li>
                </ul>
              </div>

              <div>
                <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="text-white">
                        {{ Auth::user()->username }}
                    </span>
                </a>
                    <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" onclick="document.getElementById('logoutform').submit()" href=""><i data-feather="log-out"aria-hidden="true"></i>{{ __('Logout') }}</a></li>
                    
                    <form action="{{ route('users.logout') }}" id="logoutform" method="post">
                        @csrf
                    </form>
                    </ul>
              </div>
      </div>
  </aside>


        <div class="main-wrapper ">
            <!-- ! Main nav -->


            <nav class="navbar  navbar-expand-lg navbar-light ">
                <div class="container-fluid">
        


                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
         
        
                      <li>
                        <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                            <span class="sr-only">Switch theme</span>
                            <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                            <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                          </button>
                      </li>
                        <li class="lang-switcher-wrapper">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (!session()->has('locale')) {{ __('English') }} @endif
                                @if (session()->get('locale') == 'en') {{ __('English') }} @endif
                                @if (session()->get('locale') == 'ar') {{ __('Arabic') }} @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('super-db.locale', 'en') }}">{{ __('English') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('super-db.locale', 'ar') }}">{{ __('Arabic') }}</a></li>
                            </ul>
                        </li>
        
                        <li class="lang-switcher-wrapper">
                            <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-white">
                                {{ Auth::user()->username }}
                            </span>
                        </a>
                            <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <button class="dropdown-item" onclick="document.getElementById('logoutform').submit()" href=""><i data-feather="log-out"aria-hidden="true"></i>{{ __('Logout') }}</button></li>
                            
                            <form action="{{ route('log') }}" id="logoutform" method="post">
                                @csrf

                            </form>
                            </ul>
                        </li>
                    
                    </ul>
                  </div>
                </div>
              </nav>


            <!-- ! Main -->


            <div class="main-content container-fluid">
                <div class="page-title m-3">

                    <h3>{{ $title }}</h3>
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">SuperDB menu</span>
                        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                      </button>
                </div>
                <div>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>

                                        {{ $message }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                </div>
                <div class="m-5">
                    
                    {{ $slot }}
                </div>

            </div>

        </div>
        </main>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Chart library -->
    <script src="/layout-assets/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="/layout-assets/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="/layout-assets/js/script.js"></script>
</body>

</html>
