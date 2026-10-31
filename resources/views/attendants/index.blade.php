<!DOCTYPE html>
<html>
<head>
    <title>Attendants List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-4">
            <h2>Attendant List</h2>
        </div>
        <div class="col-md-8 d-flex justify-content-end align-items-center gap-2 flex-wrap">
            <!-- Search Form -->
            <form action="{{ route('attendants.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
                @if(request('search'))
                    <a href="{{ route('attendants.index') }}" class="btn btn-outline-secondary ms-1">Reset</a>
                @endif
            </form>

            <a href="{{ route('attendants.create') }}" class="btn btn-primary">+ Add Attendant</a>
            
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendants as $attendant)
                        <tr>
                            <td>{{ $attendant->id }}</td>
                            <td>{{ $attendant->name }}</td>
                            <td>{{ $attendant->email }}</td>
                            <td>{{ $attendant->phone ?? 'N/A' }}</td>
                            <td>{{ $attendant->department->name ?? 'N/A' }}</td>
                            <td>
                                <!-- Edit Button with Icon and Text -->
                                <a href="{{ route('attendants.edit', $attendant->id) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                
                                <!-- Delete Button with Icon and Text triggering Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="{{ route('attendants.destroy', $attendant->id) }}" data-name="{{ $attendant->name }}">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No attendants found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Success Notification Modal -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-check-circle-fill text-success fs-1 mb-3 d-block"></i>
                <p class="fs-5 mb-0">{{ session('success') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="attendantName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scripts to handle modals -->
<script>
    // Auto-show success modal if session exists
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif
    });

    // Handle delete modal dynamic data
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        const name = button.getAttribute('data-name');
        
        const form = deleteModal.querySelector('#deleteForm');
        const attendantNameSpan = deleteModal.querySelector('#attendantName');
        
        form.action = url;
        attendantNameSpan.textContent = name;
    });
</script>
</body>
</html>