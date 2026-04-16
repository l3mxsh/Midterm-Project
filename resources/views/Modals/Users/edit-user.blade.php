<div class="modal fade" id="userEditModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-column flex-md-row mb-3 gap-3">
                        <div class="form-floating">
                            <input type="text" class="form-control input-underline" id="modal-name" name="name" placeholder="Full Name" required>
                            <label for="modal-name">Full Name</label>
                        </div>
                        <div class="form-floating">
                            <input type="email" class="form-control input-underline" id="modal-email" name="email" placeholder="Email" required>
                            <label for="modal-email">Email</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control input-underline" id="modal-address" name="address" placeholder="Address" required>
                        <label for="modal-address">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select input-underline" id="modal-gender" name="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="modal-gender">Gender</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-danger w-100 rounded-1 fw-bold mb-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger w-100 rounded-1 fw-bold mb-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('userEditModal').addEventListener('show.bs.modal', function (e) {
        const button = e.relatedTarget;
        const id = button.getAttribute('data-id');
        document.getElementById('modal-name').value = button.getAttribute('data-name');
        document.getElementById('modal-email').value = button.getAttribute('data-email');
        document.getElementById('modal-address').value = button.getAttribute('data-address');
        document.getElementById('modal-gender').value = button.getAttribute('data-gender');
        document.getElementById('editUserForm').action = `/dashboard/users/${id}`;
    });
</script>
@endpush
