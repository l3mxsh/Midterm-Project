<div class="modal fade" id="userAddModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="d-flex flex-row gap-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control input-underline" id="modal-name" name="name"
                                placeholder="Full Name" required>
                            <label for="name">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control input-underline" id="modal-email" name="email"
                                placeholder="Email" required>
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control input-underline" id="modal-address" name="address"
                            placeholder="Address" required>
                        <label for="address">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select input-underline" id="modal-gender" name="gender" aria-label="Gender"
                            required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>

                    <div class="d-flex flex-row gap-3">
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control input-underline pe-5" id="password"
                                name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            <button type="button"
                                class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                                data-target="#password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control input-underline pe-5" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password_confirmation">Confirm Password</label>
                            <button type="button"
                                class="toggle-password btn btn-sm position-absolute end-0 top-50 translate-middle-y"
                                data-target="#password_confirmation">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-2">
                        <button type="button" class="btn btn-outline-danger w-100 rounded-1 fw-bold mb-2"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger w-100 rounded-1 fw-bold mb-2">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>