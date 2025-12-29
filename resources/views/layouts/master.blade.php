<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-layout="vertical"
      data-topbar="dark"
      data-sidebar="dark"
      data-sidebar-size="lg"
      data-sidebar-image="none"
      data-bs-theme="dark"
      data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Ticketing System')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Ticketing Support System" name="description" />
    <meta content="Your Company" name="author" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('build/images/iconn.png') }}">

    @include('partials.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div id="layout-wrapper">
        @include('partials.navbar')
        @include('partials.sidebar')
        <div class="main-content">
            <div class="page-content">
                @include('partials.confirm-modal')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.scripts')

    @stack('scripts')
</body>
</html>