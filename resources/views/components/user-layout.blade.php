<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ APP::isLocale('ar') ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="author" content="" />
        <title>Super-DB</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('/user-layout-assets/assets/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->

        <link href="{{ asset('/user-layout-assets/css/styles.css') }}" rel="stylesheet" />

        
        @if (APP::isLocale('ar'))
        <link href="{{ asset('/user-layout-assets/css/style-rtl.css') }}" rel="stylesheet" />

        @else   
        <link href="{{ asset('/user-layout-assets/css/styles.css') }}" rel="stylesheet" />
        @endif


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand glitch" href="#page-top"data-text="Super DB" style=" color: #CEF0D4; font-family: 'Brush Script MT', Brush Script Std, cursive	; font-size: 20px; text-align: center; text-shadow: 1px 1px 10px #ffffff;">Super DB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class=" collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#Main">{{ __('Main') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">{{ __('Services') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">{{ __('Team') }}</a></li>
                        <li class="lang-switcher-wrapper">
                            <div>
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (!session()->has('locale')) {{ __('English') }} @endif
                                    @if (session()->get('locale') == 'en') {{ __('English') }} @endif
                                    @if (session()->get('locale') == 'ar') {{ __('Arabic') }} @endif
                                </a>
                                <ul class="dropdown-menu lang-switcher-wrapper" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('super-db.locale', 'en') }}">{{ __('English') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('super-db.locale', 'ar') }}">{{ __('Arabic') }}</a></li>
                                </ul>
                              </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        


        <div>
            
            {{ $slot }}
        </div>


        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Super DB &copy;  2021</div>
 
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('/user-layout-assets/js/scripts.js') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/react/16.13.1/umd/react.production.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/react-dom/16.13.1/umd/react-dom.production.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/styled-components/3.2.1/styled-components.min.js'></script>
    </body>
</html>
