<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        {{-- Dashboard --}}
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(in_array(Auth::user()->role->name, ['Admin', 'Staff']))
        <!-- Categories -->
        <!-- Products -->
        <!-- Borrowings -->
        @endif

        @if(Auth::user()->role->name == 'Admin')
        <!-- Users -->
        @endif

        {{-- Categories --}}
        <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="mdi mdi-shape menu-icon"></i>
                <span class="menu-title">Categories</span>
            </a>
        </li>

        {{-- Products --}}
        <li class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="mdi mdi-package-variant menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>

        {{-- Borrowings --}}
        <li class="nav-item {{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('borrowings.index') }}">
                <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">Borrowings</span>
            </a>
        </li>

        {{-- Users --}}
        @if(Auth::user()->role->name == 'Admin')
        <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        @endif

        <li class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="mdi mdi-logout menu-icon text-danger"></i>
                    <span class="menu-title text-danger">Logout</span>
                </button>
            </form>
        </li>

    </ul>

</nav>
