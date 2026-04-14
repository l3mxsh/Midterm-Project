<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title', 'Auth')</title>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="card p-4 shadow w-25" >
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60" class="mb-2">
            <h6 class="fw-bold text-danger">A$T</h6>
        </div>

        @yield('content')
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="toast align-items-center text-bg-danger border-0" role="alert" data-bs-autohide="true"
                    data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body">{{ $error }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="toast align-items-center text-bg-success border-0" role="alert" data-bs-autohide="true"
                data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
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
                delay: 1000
            }).show();
        });

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
</body>

</html>