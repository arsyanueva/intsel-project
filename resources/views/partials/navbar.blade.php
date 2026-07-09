<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">

    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center"
                    type="button"
                    data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>

        <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/intsel/logo-intsel.png') }}"
                alt="Telkomsel Logo"
                height="40"
                class="d-inline-block align-top me-2">
        </a>

    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <h4 class="mb-0">
                    Welcome,
                    <strong>
                        {{ Auth::user()->name }}
                    </strong>
                </h4>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#"
                   data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <span class="dropdown-item-text">
                        {{ Auth::user()->email }}
                    </span>
                    <div class="dropdown-divider"></div>
                    <form method="POST"
                          action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
