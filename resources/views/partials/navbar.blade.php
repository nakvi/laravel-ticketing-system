<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header " style="background-color: #3c3f42;">
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo bg-primary">
                    <a href="{{ url('dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('build/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>
                    <a href="{{ url('dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="" height="40">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span><span></span><span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <!-- Fullscreen Button -->
                <div class="ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                src="{{ Auth::user()->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                                alt="User">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-semibold user-name-text">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">
                                    {{ Auth::user()->role ?? 'User' }}
                                </span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bx bx-user fs-16 align-middle me-1"></i> Profile
                        </a>
                        <!-- New: Lock Screen -->
                        <a class="dropdown-item" href="{{ route('lock') }}">
                            <i class="bx bx-lock-alt fs-16 align-middle me-1"></i> Lock Screen
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off fs-16 align-middle me-1"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>