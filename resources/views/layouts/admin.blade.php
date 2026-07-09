<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Inventory Management')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body.dark-mode {
            background-color: #111827;
            color: #e5e7eb;
        }

        body.dark-mode .page-body-wrapper,
        body.dark-mode .main-panel,
        body.dark-mode .content-wrapper,
        body.dark-mode .sidebar,
        body.dark-mode .navbar,
        body.dark-mode .footer,
        body.dark-mode .card,
        body.dark-mode .table,
        body.dark-mode .modal-content,
        body.dark-mode .dropdown-menu,
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #1f2937;
            color: #e5e7eb;
            border-color: #374151;
        }

        body.dark-mode .sidebar {
            background-color: #232227;
        }

        body.dark-mode .navbar {
            background-color: #232227;
        }

        body.dark-mode .navbar .navbar-brand-wrapper,
        body.dark-mode .navbar .navbar-menu-wrapper {
            background-color: #232227;
        }

        body.dark-mode .sidebar .nav-link,
        body.dark-mode .sidebar .menu-title,
        body.dark-mode .sidebar .nav-item.nav-category,
        body.dark-mode .navbar .nav-link .dropdown-toggle,
        body.dark-mode .dropdown-item,
        body.dark-mode .card .card-body,
        body.dark-mode .card .card-title,
        body.dark-mode .card-header,
        body.dark-mode .card-footer,
        body.dark-mode .table th,
        body.dark-mode .table td,
        body.dark-mode .alert {
            color: #e5e7eb;
        }

        body.dark-mode .sidebar .nav-item.active > .nav-link,
        body.dark-mode .sidebar .nav:not(.sub-menu) > .nav-item:hover > .nav-link,
        body.dark-mode .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }

        body.dark-mode .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: rgba(255, 255, 255, 0.03);
        }

        body.dark-mode .btn-outline-secondary,
        body.dark-mode .btn-outline-success {
            color: #e5e7eb;
            border-color: #6b7280;
        }

        body.dark-mode .btn-outline-secondary:hover,
        body.dark-mode .btn-outline-success:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select,
        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background-color: #1f2937;
            border-color: #374151;
            color: #e5e7eb;
            box-shadow: none;
        }

        body.dark-mode .table-bordered th,
        body.dark-mode .table-bordered td {
            border-color: #374151;
        }
    </style>

</head>

<body>

<div class="container-scroller">

    @include('partials.navbar')

    <div class="container-fluid page-body-wrapper">

        @include('partials.sidebar')

        <div class="main-panel">

            <div class="content-wrapper">

                @yield('content')

            </div>

            @include('partials.footer')

        </div>

    </div>

</div>

{{-- JS --}}

<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
@stack('scripts')

</body>

</html>
