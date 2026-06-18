<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFWR</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> -->
     @vite('resources/css/Admin/admin.css')
</head>

<body>

    <!-- Background -->
    <div class="bg-gradient"></div>

    <div class="admin-wrapper">

        <!-- LEFT PANEL -->
        <div class="admin-left">

            <div class="brand">

                <div class="brand-logo">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div>
                    <h2>SMART FOOD WASTE REDUCER (SFWR)</h2>
                    
                </div>

            </div>

            <div class="admin-content">

                

                <h1>
                    Smart Food Waste <br>
                    Reducer 
                </h1>

                <p>
                    Manage users, monitor food distribution activities,
                    oversee analytics, and maintain sustainability operations
                    through a centralized administrative system.
                </p>

                <!-- ADMIN FEATURES -->

                <div class="admin-features">

                    <div class="admin-card">
                        <i class="fa-solid fa-chart-line"></i>

                        <div>
                            <h3>Analytics Dashboard</h3>
                            <p>Monitor platform statistics and activity.</p>
                        </div>
                    </div>

                    <div class="admin-card">
                        <i class="fa-solid fa-users"></i>

                        <div>
                            <h3>User Management</h3>
                            <p>Control and manage platform users securely.</p>
                        </div>
                    </div>

                    <div class="admin-card">
                        <i class="fa-solid fa-lock"></i>

                        <div>
                            <h3>Secure Access</h3>
                            <p>Protected authentication and admin controls.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT LOGIN PANEL -->

        <div class="admin-right">

            <div class="admin-login-card">

                <div class="top-indicator"></div>

                <div class="login-header">

                    <div class="admin-icon">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>

                    <h2>Account Login</h2>

                    <p>
                        Enter your username and password to continue.
                    </p>

                </div>

                <!-- FORM -->

                <form method="POST" action="{{ route('login.submit') }}">
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
                                placeholder="Enter Username"
                                value="{{ old('username') }}"
                                required
                            >
                        </div>

                    </div>

                    <div class="input-group">

                        <label>Password</label>

                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>

                            <input
                                type="password"
                                name="password"
                                placeholder="Enter Password"
                            >
                        </div>

                    </div>

                    <!-- OPTIONS -->

                    <div class="login-options">

                        <label>
                            <input type="checkbox">
                            Keep me signed in
                        </label>

                        <a href="{{ route('register') }}">
                            Register Here
                        </a>

                    </div>

                    <!-- BUTTON -->

                    <button class="admin-btn">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Secure Login
                    </button>
                    <div style="text-align:center;margin-top:15px;">
                        <a href="{{ route('admin.login') }}">
                            Admin Login
                        </a>
                    </div>
                </form>

                <!-- SECURITY INFO -->

                <div class="security-info">

                    <div>
                        <i class="fa-solid fa-circle-check"></i>
                        Encrypted Authentication
                    </div>

                    <div>
                        <i class="fa-solid fa-server"></i>
                        Protected Server Access
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
