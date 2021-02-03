<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link
        href="{{ get_setting_by_key('logo')->image_path ?? asset('dist/images/logo.png') }}"
        rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Cosmatics DashBoard</title>
    <!-- BEGIN: Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap">
    <!-- BEGIN: Google Fonts -->


    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/print.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* START:: ROOT SELECTOE */
        :root {
            --mainBackGround: linear-gradient(to bottom, #0d697e, #a056c5, #961f60);
        }

        /* START:: ROOT SELECTOE */

    </style>
    @stack('styles')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="app">

    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden py-6">
        <div class="mobile-menu-bar flex justify-between">
            <a href="" class="flex">
                <img alt="" class="w-14" src="{{ get_setting_by_key('logo')->image_path ?? asset('dist/images/logo.png') }}" style="max-width: 150px; max-height: 75px">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler">
                <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
            </a>
        </div>
        <ul class="py-5 hidden">
            <li>
                <a href="{{ route('home') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="home"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> Home </span> </div>
                </a>
            </li>

            @if(auth()->user()->role == 'doctor')
            <li>
                <a href="{{ route('settings.system') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="settings"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> System Settings </span>
                    </div>
                </a>
            </li>
            @endif

            <li>
                <a href="{{ route('edit_profile') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="settings"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> Edit Profile </span>
                    </div>
                </a>
            </li>

            @if(auth()->user()->role == 'doctor')
            <li>
                <a href="{{ route('users.index') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="users"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> All Users </span> </div>
                </a>
            </li>
            @endif

            <li>
                <a href="{{ route('patients.index') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="users"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> All Patients </span>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('online_visits') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="users"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> Requests </span>
                    </div>
                </a>
            </li>


            <li>
                <a href="{{ route('visits.index') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="inbox"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> All Reservation </span>
                    </div>
                </a>
            </li>

            @if(auth()->user()->role == 'doctor')
            <li>
                <a href="{{ route('clinics.index') }}" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="hash"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> Clinics </span> </div>
                </a>
            </li>
            @endif


            @if(auth()->user()->role == 'doctor')
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i class="ml-3" data-feather="pie-chart"></i> </div>
                    <div class="menu__title"> <span class="xl:block text-white text-lg ml-3"> Reports </span> <i
                            data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('reports.surgeries') }}" class="menu">
                            <div class="menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                            <div class="menu__title"> Surgeries Report </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.surgeries_payment') }}" class="menu">
                            <div class="menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                            <div class="menu__title"> Surgeries Financial Report </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.hospitals') }}" class="menu">
                            <div class="menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                            <div class="menu__title"> Hospitals Financial Report </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.patients') }}" class="menu">
                            <div class="menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                            <div class="menu__title"> Patients Reports </div>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
    <!-- END: Mobile Menu -->

    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav pt-2">
            <a href="{{ route('home') }}" class="nav-brand intro-x flex items-center">
                <img alt="" class="w-44"
                    src="{{ get_setting_by_key('logo')->image_path ?? asset('dist/images/icon.png') }}">
            </a>

            <ul>
                <li>
                    <a href="{{ route('home') }}"
                        class="side-menu {{ is_active('home') }}">
                        <div class="side-menu__icon"> <i class="ml-3" data-feather="home"></i> </div>
                        <div class="side-menu__title"> Home </div>
                    </a>
                </li>

                @if(auth()->user()->role == 'doctor')
                    <li>
                        <a href="{{ route('settings.system') }}"
                            class="side-menu {{ is_active('settings.system') }}">
                            <div class="side-menu__icon"> <i class="ml-3" data-feather="settings"></i> </div>
                            <div class="side-menu__title"> System Settings </div>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('edit_profile') }}"
                        class="side-menu {{ is_active('edit_profile') }}">
                        <div class="side-menu__icon"> <i class="ml-3" data-feather="settings"></i> </div>
                        <div class="side-menu__title"> Edit Profile </div>
                    </a>
                </li>

                @if(auth()->user()->role == 'doctor')
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="side-menu {{ is_active('users.index') }}">
                            <div class="side-menu__icon"> <i class="ml-3" data-feather="users"></i> </div>
                            <div class="side-menu__title"> All Users </div>
                        </a>
                    </li>
                @endif


                <li>
                    <a href="{{ route('patients.index') }}"
                        class="side-menu {{ is_active('patients.index') }}">
                        <div class="side-menu__icon"> <i class="ml-3" data-feather="users"></i> </div>
                        <div class="side-menu__title"> All Patients </div>
                    </a>
                </li>


                <li>
                    <a href="{{ route('online_visits') }}"
                        class="side-menu {{ is_active('online_visits') }}">
                        <div class="side-menu__icon"> <i class="ml-3" data-feather="users"></i> </div>
                        <div class="side-menu__title"> Requests </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('visits.index') }}"
                        class="side-menu {{ is_active('visits.index') }}">
                        <div class="side-menu__icon"> <i class="ml-3" data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> All Reservation </div>
                    </a>
                </li>

                @if(auth()->user()->role == 'doctor')
                    <li>
                        <a href="{{ route('clinics.index') }}"
                            class="side-menu {{ is_active('clinics.index') }}">
                            <div class="side-menu__icon"> <i class="ml-3" data-feather="hash"></i> </div>
                            <div class="side-menu__title"> Clinics </div>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="javascript:;"
                        class="side-menu {{ drop_active() ? 'side-menu--open' : '' }}">
                        <div class="side-menu__icon"> <i class="ml-3" data-feather="pie-chart"></i> </div>
                        <div class="side-menu__title"> Reports <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul
                        class="{{ drop_active() ? 'side-menu__sub-open' : '' }}">
                        @if(auth()->user()->role == 'doctor')
                            <li>
                                <a href="{{ route('reports.surgeries') }}"
                                    class="side-menu {{ is_active('reports.surgeries') }}">
                                    <div class="side-menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                                    <div class="side-menu__title"> Surgeries Report </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('reports.surgeries_payment') }}"
                                    class="side-menu {{ is_active('reports.surgeries_payment') }}">
                                    <div class="side-menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                                    <div class="side-menu__title"> Surgeries Financial Report </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('reports.hospitals') }}"
                                    class="side-menu {{ is_active('reports.hospitals') }}">
                                    <div class="side-menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                                    <div class="side-menu__title"> Hospitals Financial Report </div>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('reports.patients') }}"
                                class="side-menu {{ is_active('reports.patients') }}">
                                <div class="side-menu__icon"> <i class="ml-3" data-feather="file-minus"></i> </div>
                                <div class="side-menu__title"> Patients Reports </div>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- <li>
				<a href="financial.php" class="side-menu">
					<div class="side-menu__icon"> <i class="ml-3" data-feather="dollar-sign"></i> </div>
					<div class="side-menu__title"> Financilas </div>
				</a>
			</li> -->

            </ul>
        </nav>
        <!-- END: Side Menu -->

        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                {{-- @php $segments = ''; @endphp
@foreach(Request::segments() as $segment)
@php$segments .= '/'.$segment; @endphp
                    <li>
                        <a href="{{ $segments }}">{{ $segment }}</a>
                </li>
                @endforeach--}}
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                    <i data-feather="home" class="breadcrumb__icon"></i>
                    <a href="#" class=""> Home</a>
                    @foreach(request()->segments() as $index => $segment)
                        @if($index < 1)
                            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                            <a href="" class="text-purple-700">{{ __('site.'.$segment) }}</a>
                        @endif
                    @endforeach
                </div>
                <!-- END: Breadcrumb -->


                <!-- BEGIN: SYSTEM THEMES -->
                <div class="intro-x dropdown relative mr-auto  ml-2 sm:mr-6">
                    <div class="dropdown-toggle notification cursor-pointer">
                        <i data-feather="droplet" class="notification__icon dark:text-gray-300"></i>
                    </div>
                    <div
                        class="notification-content dropdown-box mt-8 absolute top-0 left-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
                        <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                            <ul class="color-themes">
                                <li class="mb-3" data-color="linear-gradient(to bottom, #0d697e, #a056c5, #961f60)">
                                    Default </li>
                                <li class="mb-3" data-color="linear-gradient(to bottom, #e67a88,#ee9ca7, #ffdde1)">
                                    Piggy Pink</li>
                                <li class="mb-3" data-color="linear-gradient(to bottom, #2c3e50,#4b6075,#bdc3c7)"> Grady
                                    Grey</li>
                                <li class="mb-3" data-color="linear-gradient(to bottom, #5d26c1, #a17fe0, #59c173)">
                                    Magic</li>
                                <li class="mb-3" data-color="linear-gradient(to bottom, #f3904f, #6239af, #3b4371)">
                                    Dawn</li>
                                <li class="mb-3" data-color="linear-gradient(to bottom, #feac5e, #c779d0, #4bc0c8)">
                                    Atlas</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: SYSTEM THEMES -->

                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8 relative">

                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img alt="Midone Tailwind HTML Admin Template" src="{{ auth()->user()->image_path }}">
                    </div>

                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">

                        <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">

                            <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                                <div class="font-medium">{{ auth()->user()->name }}</div>
                                {{-- <div class="text-xs text-theme-41 dark:text-gray-600">Software Engineer</div> --}}
                            </div>

                            <div class="p-2">

                                <div class="p-2">
                                    <a href="{{ route('edit_password') }}"
                                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                        <i data-feather="key" class="w-4 h-4 mr-2 ml-2"></i> Reset Password
                                    </a>
                                </div>

                                <a href=""
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="help-circle" class="w-4 h-4 mr-2 ml-2"></i> Help
                                </a>
                            </div>

                            <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="power" class="w-4 h-4 mr-2 ml-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- END: Top Bar -->
