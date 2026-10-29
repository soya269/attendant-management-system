<!DOCTYPE html>
<html>
<head>
    <title>Attendants List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Attendant List</h2>
        <div>
            <a href="{{ route('attendants.create') }}" class="btn btn-primary">+ Add Attendant</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger ms-2">Logout</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                                <a href="{{ route('attendants.edit', $attendant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('attendants.destroy', $attendant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this attendant?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>