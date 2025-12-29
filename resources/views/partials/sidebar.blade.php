<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('build/images/iconn.png') }}" alt="Logo" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('build/images/iconn.png') }}" alt="Logo" height="120">
            </span>
        </a>
        <a href="{{ url('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('build/images/iconn.png') }}" alt="Logo" height="22" width="">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('build/images/iconn.png') }}" alt="Logo" height="120">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                {{-- Admin Menu --}}
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->is('admin*') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="ri-shield-user-line"></i>
                                <span>Admin Panel</span>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/tickets*') ? 'active' : '' }}"
                            href="{{ route('admin.tickets.index') }}">
                            <i class="ri-ticket-line"></i>
                            <span>All Tickets</span>
                        </a>
                    </li>
               
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <i class="ri-team-line"></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('categories*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i class="ri-folder-settings-line"></i>
                        <span>Manage Categories</span>
                    </a>
                </li>
                 @endif
                 @if(Auth::user()->role === 'agent')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('agent*') ? 'active' : '' }}"
                    href="{{ route('agent.dashboard') }}">
                        <i class="ri-customer-service-2-line"></i>
                        <span>Agent Dashboard</span>
                    </a>

                     <li class="nav-item">
                    <a class="nav-link {{ request()->is('agent*') ? 'active' : '' }}"
                    href="{{ route('agent.tickets.index') }}">
                        <i class="ri-ticket-2-line"></i>
                        <span>Agent Tickets</span>
                    </a>
                </li>                    @endif
                {{-- Admin Menu End --}}
                {{-- User Menu --}}
                <!-- Dashboard -->
                @if(auth()->user()->role === 'customer')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Tickets Menu - Always visible to all authenticated users -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('tickets*') ? 'active' : '' }}"
                        href="{{ route('tickets.index') }}">
                        <i class="ri-ticket-2-line"></i>
                        <span>My Tickets</span>
                    </a>

                </li>
                @endif

                <!-- My Tickets (for Customers) -->
                {{-- @if(auth()->user()->role === 'customer')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('tickets.my') ? 'active' : '' }}"
                        href="{{ route('tickets.my') }}">
                        <i class="ri-file-list-3-line"></i>
                        <span>My Tickets</span>
                    </a>
                </li>
                @endif --}}

                <!-- Categories (Admin only) -->
                {{-- @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('categories*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i class="ri-folder-settings-line"></i>
                        <span>Categories</span>
                    </a>
                </li>
                @endif --}}

                <!-- Users Management (Admin only) -->
                {{-- @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('users*') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">
                        <i class="ri-team-line"></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                @endif --}}

                <!-- Reports (Agent & Admin) -->
                {{-- @if(in_array(auth()->user()->role, ['agent', 'admin']))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('reports*') ? 'active' : '' }}"
                        href="{{ route('reports.index') }}">
                        <i class="ri-bar-chart-line"></i>
                        <span>Reports</span>
                    </a>
                </li>
                @endif --}}

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<div class="vertical-overlay"></div>