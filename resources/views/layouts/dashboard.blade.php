<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>@yield('title', 'Dashboard')</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="d-flex flex-grow-1">

        {{-- Sidebar --}}
        <div id="sidebar" class="d-flex flex-column p-2">
            <div class="sidebar-header d-flex align-items-center justify-content-between mb-3 px-1">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('images/white-logo.png') }}" alt="Logo" width="46" class="sidebar-logo">
                    <span class="text-white fw-bold medium brand-text">A$T</span>
                </div>
                <button id="toggle-btn" title="Toggle Sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <ul class="nav flex-column gap-1 flex-grow-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span class="link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/student"
                        class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/student') ? 'active' : '' }}">
                        <i class="bi bi-journal"></i>
                        <span class="link-text">Student Record</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/users"
                        class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/users') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span class="link-text">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/settings"
                        class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/settings') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        <span class="link-text">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn nav-link text-white d-flex align-items-center gap-2 w-100">
                            <i class="bi bi-box-arrow-left"></i>
                            <span class="link-text">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="d-flex flex-column flex-grow-1 w-100">

            <main class="p-4 flex-grow-1">
                @yield('content')
            </main>

            <footer class="bg-light border-top text-center text-muted small py-3">
                &copy; {{ date('Y') }} A$T. All rights reserved.
            </footer>
        </div>

    </div>

    {{-- Toast Container --}}
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
        @foreach ($errors->all() as $error)
            <div class="toast align-items-center text-bg-danger border-0" role="alert" data-bs-autohide="true"
                data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">{{ $error }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endforeach
        @if (session('success'))
            <div class="toast align-items-center text-bg-success border-0" role="alert" data-bs-autohide="true"
                data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @elseif (session('success-red'))
            <div class="toast align-items-center text-bg-danger border-0" role="alert" data-bs-autohide="true"
                data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success-red') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('.toast').forEach(el => {
            new bootstrap.Toast(el, {
                delay: 3000
            }).show();
        });

        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('collapsed'));

        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.querySelector(btn.dataset.target);
                const icon = btn.querySelector('i');
                input.type = input.type === 'password' ? 'text' : 'password';
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        });
    </script>
    @stack('scripts')
</body>

</html>