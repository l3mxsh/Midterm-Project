@extends('layouts.dashboard')

@section('title', 'Settings')

@section('content')
    <h4 class="fw-bold mb-4">Settings</h4>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-5 border-0 h-auto">

                    <img id="profileImage" src="{{ asset($profile->imgpath ?? 'images/default.jpg') }}"
                        class="rounded-circle shadow border border-4 border-danger mx-auto"
                        style="width: 150px; height: 150px; object-fit: cover;">

                    <h5 class="fw-bold mt-3 mb-3">{{ $profile->name }}</h5>

                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('profile.updateImg', $profile->id) }}">
                        @csrf

                        <label class="btn btn-outline-danger w-100 mb-2">
                            Choose Image
                            <input type="file" name="imgpath" accept=".jpg, .jpeg, .png" onchange="previewAvatar(event)"
                                hidden>
                        </label>

                        <button type="submit" class="btn btn-danger w-100">
                            Save Image
                        </button>
                    </form>

                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4 h-100">

                    <form method="POST" action="{{ route('profile.update', $profile->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- USER DETAILS -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2">User Details</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control input-underline" id="modal-name" name="name"
                                        value="{{ $profile->name }}" required>
                                    <label for="modal-name">Full Name</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control input-underline" id="modal-email" name="email"
                                        value="{{ $profile->email }}" required>
                                    <label for="modal-email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control input-underline" id="modal-address" name="address"
                                value="{{ $profile->address }}" required>
                            <label for="modal-address">Address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select input-underline" id="modal-gender" name="gender" required>
                                <option value="" disabled>Select Gender</option>
                                <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <label for="modal-gender">Gender</label>
                        </div>
                        <h5 class="fw-bold mb-3 mt-4 border-bottom pb-2">Change Password</h5>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control input-underline pe-5" id="current-password"
                                name="current_password" placeholder="Current Password">

                            <label for="current-password">Current Password</label>

                            <button type="button"
                                class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                                data-target="#current-password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control input-underline pe-5" id="new-password"
                                name="new_password" placeholder="New Password">

                            <label for="new-password">New Password</label>

                            <button type="button"
                                class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                                data-target="#new-password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="form-floating mb-4 position-relative">
                            <input type="password" class="form-control input-underline pe-5" id="confirm-password"
                                name="new_password_confirmation" placeholder="Confirm Password">

                            <label for="confirm-password">Confirm Password</label>

                            <button type="button"
                                class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                                data-target="#confirm-password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 fw-bold">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
<script>
    function previewAvatar(event) {
        const input = event.target;
        const preview = document.getElementById('profileImage');

        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Optional: check file type
            if (!file.type.startsWith('image/')) {
                alert('Image files only!');
                input.value = "";
                return;
            }

            // Preview image
            preview.src = URL.createObjectURL(file);
        }
    }
</script>