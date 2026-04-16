@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="d-flex flex-column flex-sm-row gap-3">
            <div class="form-floating mb-3">
                <input type="text" class="form-control input-underline" id="name" name="name" placeholder="Full Name"
                    value="{{ old('name') }}" required>
                <label for="name">Full Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control input-underline" id="email" name="email" placeholder="Email"
                    value="{{ old('email') }}" required>
                <label for="email">Email</label>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control input-underline" id="address" name="address" placeholder="Address"
                value="{{ old('address') }}" required>
            <label for="address">Address</label>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select input-underline" id="gender" name="gender" aria-label="Gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label for="gender">Gender</label>
        </div>

        <div class="d-flex flex-column flex-md-row gap-3">
            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control input-underline pe-5" id="password" name="password"
                    placeholder="Password" required>
                <label for="password">Password</label>
                <button type="button" class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                    data-target="#password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control input-underline pe-5" id="password_confirmation"
                    name="password_confirmation" placeholder="Confirm Password" required>
                <label for="password_confirmation">Confirm Password</label>
                <button type="button" class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                    data-target="#password_confirmation">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <button type="submit" class="btn btn-danger w-100 rounded-1 fw-bold mb-2">SIGN UP</button>
        <a href="{{ route('login') }}" class="btn btn-outline-danger w-100 rounded-1 fw-bold">BACK TO LOGIN</a>
    </form>
@endsection