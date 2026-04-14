<div class="modal fade" id="studentDeleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="deleteStudentForm" method="POST" class="text-center">
                    @csrf
                    @method('DELETE')
                    <p class="fs-4 fw-semibold text-dark">
                        Are you sure you want to delete <span id="deleteUserName"></span>?
                    </p>
                    <p class="small text-danger">This action cannot be undone.</p>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark w-100 rounded-1 fw-bold"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-1 fw-bold">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('studentDeleteModal').addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name');
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteStudentForm').action = `/dashboard/student/${id}`;
    });
</script>
@endpush
