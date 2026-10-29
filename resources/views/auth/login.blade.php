<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
<div class="container" style="max-width: 450px;">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Login Form</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="adminwoman@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="....." required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>