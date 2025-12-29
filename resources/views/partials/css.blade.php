@yield('css')
<!-- Layout config Js -->
<script src="{{ URL::asset('build/js/layout.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">


<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('build/css/custom.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
{{-- @yield('css') --}}

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    :root {
        --bs-primary: #cf1f29; /* New Primary Color */
        --vz-primary-border-subtle: #e94b52; /* Subtle lighter border color */
        --bs-primary-rgb: 207, 31, 41; /* RGB equivalent of #cf1f29 */
    }
    :root {
    --vz-vertical-menu-bg: transparent;
    --vz-vertical-menu-border: #e9ebec;
    --vz-vertical-menu-item-color: #6d7080;
    --vz-vertical-menu-item-bg: rgba(207, 31, 41, 0.15); /* Light background for menu items */
    --vz-vertical-menu-item-hover-color: #cf1f29; /* Primary color for hover */
    --vz-vertical-menu-item-active-color: #cf1f29; /* Primary color for active */
    --vz-vertical-menu-item-active-bg: rgba(207, 31, 41, 0.15);
    --vz-vertical-menu-sub-item-color: #7c7f90;
    --vz-vertical-menu-sub-item-hover-color: #cf1f29;
    --vz-vertical-menu-sub-item-active-color: #cf1f29;
    --vz-vertical-menu-title-color: #919da9;
    --vz-vertical-menu-box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
    --vz-vertical-menu-dropdown-box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
}

:root[data-sidebar="dark"] {
    --vz-vertical-menu-bg: #6b1419; /* Darkened version of primary color */
    --vz-vertical-menu-border: #6b1419;
    --vz-vertical-menu-item-color: #f3b6ba; /* Light shade for contrast */
    --vz-vertical-menu-item-bg: rgba(255, 255, 255, 0.15);
    --vz-vertical-menu-item-hover-color: #fff; /* White hover text */
    --vz-vertical-menu-item-active-color: #fff;
    --vz-vertical-menu-item-active-bg: rgba(255, 255, 255, 0.15);
    --vz-vertical-menu-sub-item-color: #e59799; /* Subtle light color for sub-items */
    --vz-vertical-menu-sub-item-hover-color: #fff;
    --vz-vertical-menu-sub-item-active-color: #fff;
    --vz-vertical-menu-title-color: #e59799;
    --vz-twocolumn-menu-iconview-bg: #a81a20; /* Darker variation for two-column view */
    --vz-vertical-menu-box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
    --vz-vertical-menu-dropdown-box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
}


    /* Buttons */
    .btn-primary {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
    }

    /* Background */
    .bg-primary {
        background-color: var(--bs-primary) !important;
    }

    /* Navbar */
    .navbar-menu {
        background-color: var(--bs-primary) !important;
    }

    .navbar-menu .navbar-nav .nav-link {
        color: #ffd5d8; /* Light text color for contrast */
    }

    .navbar-menu .navbar-nav .nav-item:hover > .menu-dropdown {
        background-color: var(--bs-primary) !important;
    }

    :is([data-layout=vertical],[data-layout=semibox])[data-sidebar-size=sm]
    .navbar-menu .navbar-nav .nav-item:hover > a.menu-link {
        background: var(--vz-primary-border-subtle) !important;
    }

    /* Tables */
    .table-primary {
        --vz-table-bg: #f6c8cb !important; /* Lighter background for table */
    }

    /* Text */
    .text-primary {
        color: var(--bs-primary) !important;
    }

    /* Borders */
    .border-primary {
        border-color: var(--bs-primary) !important;
    }

    .border-primary-subtle {
        border-color: var(--vz-primary-border-subtle) !important;
    }

    /* DataTables Pagination */
    .dataTables_wrapper .dataTables_paginate .pagination .page-item .page-link {
        color: var(--bs-primary);
        background-color: transparent;
        border-color: var(--bs-primary);
    }

    .dataTables_wrapper .dataTables_paginate .pagination .page-item.active .page-link,
    .dataTables_wrapper .dataTables_paginate .pagination .page-item .page-link:hover {
        color: #fff;
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    /* Nav Pills */
    .nav-pills .nav-link.active,
    .nav-pills .show > .nav-link {
        background-color: var(--bs-primary) !important;
    }

    /* Select2 */
    .select2-selection__choice {
        background-color: var(--bs-primary) !important;
        color: #fff;
    }

    /* Authentication Page Background */
    .auth-one-bg .bg-overlay {
        background: linear-gradient(to right, #e34b52, #cf1f29);
        opacity: 0.9;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm{
        background-color: var(--bs-primary)!important;
        color: #fff;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus{
        background-color: var(--bs-primary)!important;
        color: #fff;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
    box-shadow: var(--bs-primary)!important;
}
.legend-color {
  display: inline-block;
  width: 15px;
  height: 15px;
  border-radius: 3px;
}


</style>
