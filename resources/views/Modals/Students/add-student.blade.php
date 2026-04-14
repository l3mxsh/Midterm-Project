<div class="modal fade" id="studentAddModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('student.create') }}">
                    @csrf
                    <div class="d-flex flex-row gap-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control input-underline" id="modal-fname" name="fname"
                                placeholder="First Name" required>
                            <label for="fname">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control input-underline" id="modal-mname" name="mname"
                                placeholder="Middle Name">
                            <label for="mname">Middle Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control input-underline" id="modal-lname" name="lname"
                                placeholder="Last Name" required>
                            <label for="lname">Last Name</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control input-underline" id="modal-address" name="address"
                            placeholder="Address" required>
                        <label for="address">Address</label>
                    </div>
                    <div class="mb-3 d-flex flex-row gap-2">
                        <div class="form-floating w-100">
                            <select class="form-select input-underline" id="modal-gender" name="gender"
                                aria-label="Gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                        <div class="form-floating">
                            <input type="number" class="form-control input-underline" id="modal-age" name="age" min="18" max="100"
                                placeholder="Age" required>
                            <label for="age">Age</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select input-underline" id="modal-program" name="program"
                            aria-label="Program" required>
                            <option value="" disabled selected>Select Program</option>
                            <option value="BSIT">BSIT</option>
                            <option value="BSCS">BSCS</option>
                            <option value="BSBA">BSBA</option>
                            <option value="BSA">BSA</option>
                            <option value="BSN">BSN</option>
                            <option value="BS Pharmacy">BS Pharmacy</option>
                            <option value="BA Comm">BA Comm</option>
                            <option value="BA Psych">BA Psych</option>
                            <option value="BSCE">BSCE</option>
                            <option value="BS Arch">BS Arch</option>
                        </select>
                        <label for="program">Program</label>
                    </div>

                    <div class="d-flex flex-row gap-2">
                        <button type="button" class="btn btn-outline-danger w-100 rounded-1 fw-bold mb-2"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger w-100 rounded-1 fw-bold mb-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>