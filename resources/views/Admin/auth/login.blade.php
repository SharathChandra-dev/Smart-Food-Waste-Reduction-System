<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SFWR</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite('resources/css/Admin/admin.css')
</head>
<body>

<div class="admin-wrapper">

    <div class="admin-left">

        <div class="brand">
            <div class="brand-logo">
                <i class="fa-solid fa-user-shield"></i>
            </div>

            <div>
                <h2>SFWR ADMIN PANEL</h2>
            </div>
        </div>

        <div class="admin-content">

            <h1>Administrator Portal</h1>

            <p>
                Manage food inventory, users, reports and system operations.
            </p>

        </div>

    </div>

    <div class="admin-right">

        <div class="admin-login-card">

            <div class="login-header">

                <div class="admin-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <h2>Admin Login</h2><form method="POST" action="{{ route('admin.login.submit') }}">

                <p>
                    Authorized administrators only.
                </p>

            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                @if ($errors->any())
                    <div style="background:#ffe6e6;color:#d60000;padding:10px;border-radius:8px;margin-bottom:15px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="input-group">

                    <label>Username</label>

                    <div class="input-wrapper">
                        <i class="fa-solid fa-user"></i>

                        <input
                            type="text"
                            name="username"
                            placeholder="Admin Username"
                            required>
                    </div>

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            name="password"
                            placeholder="Admin Password"
                            required>
                    </div>

                </div>

                <button type="submit" class="admin-btn">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login as Admin
                </button>
                <div style="text-align:center;margin-top:15px;">
                    <a href="{{ route('login') }}">
                        User Login
                    </a>
                </div>
            </form>

        </div>

    </div>

</div>

</body>
</html>