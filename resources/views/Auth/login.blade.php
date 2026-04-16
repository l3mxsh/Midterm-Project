@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control input-underline" id="email" name="email" placeholder="Email"
                value="{{ old('email') }}" required>
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3 position-relative">
            <input type="password" class="form-control input-underline pe-5" id="password" name="password"
                placeholder="Password" required>
            <label for="password">Password</label>
            <button type="button" class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                data-target="#password">
                <i class="bi bi-eye"></i>
            </button>
        </div>
        <button type="submit" class="btn btn-danger w-100 rounded-1 fw-bold my-2">SIGN IN</button>
        <a href="{{ route('register') }}" class="btn btn-outline-danger w-100 rounded-1 fw-bold mb-2">SIGN UP</a>
    </form>
@endsection