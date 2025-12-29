<!doctype html>

        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-body-image="img-1" data-sidebar-image="none" data-bs-theme="dark">

    <head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ URL::asset('build/images/iconn.png')}}">
        @include('partials.css')
  </head>

    @yield('body')

    @yield('content')

    @include('partials.scripts')
    </body>
</html>
