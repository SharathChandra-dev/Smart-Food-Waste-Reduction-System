<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SFWR Register</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- CSS -->
    @vite('resources/css/Admin/admin.css')

</head>

<body>

    <div class="bg-gradient"></div>

    <div class="admin-wrapper">

        <div class="admin-left">

            <div class="brand">

                <div class="brand-logo">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div>
                    <h2>SFWR</h2>
                    <span>Smart Sustainable Platform</span>
                </div>

            </div>

            <div class="admin-content">

                <div class="admin-badge">
                    Secure Registration
                </div>

                <h1>
                    Create Your <br>
                    Smart Account
                </h1>

                <p>
                    Join the Smart Food Waste Reducer platform and contribute toward sustainable food management with a secure login experience.
                </p>

                <div class="admin-features">

                    <div class="admin-card">
                        <i class="fa-solid fa-user-shield"></i>
                        <div>
                            <h3>Secure Access</h3>
                            <p>Advanced authentication for your account.</p>
                        </div>
                    </div>

                    <div class="admin-card">
                        <i class="fa-solid fa-chart-line"></i>
                        <div>
                            <h3>Smart Dashboard</h3>
                            <p>Manage your activity from one place.</p>
                        </div>
                    </div>

                    <div class="admin-card">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        <div>
                            <h3>Community Impact</h3>
                            <p>Support local redistribution efforts.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="admin-right">

            <div class="admin-login-card">

                <div class="top-indicator"></div>

                <div class="login-header">

                    <div class="admin-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>

                    <h2>Create Account</h2>

                    <p>
                        Register to access the Smart Food Waste Reducer platform
                    </p>

                </div>

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <div class="input-group">
                        <label>Username</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="name" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Email Address</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" placeholder="Enter Email Address" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Create Password" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="login-options">
                        <label>
                            <input type="checkbox" required>
                            I agree to Terms & Conditions
                        </label>
                    </div>

                    <button type="submit" class="admin-btn">
                        <i class="fa-solid fa-user-plus"></i>
                        Create Account
                    </button>

                    <div class="security-info">
                        <div>
                            <i class="fa-solid fa-circle-check"></i>
                            Secure registration and encrypted data.
                        </div>
                    </div>

                    <div class="bottom-text" style="margin-top:24px; color:#7b6555; text-align:center;">
                        Already have an account?
                        <a href="{{ route('login') }}">Login</a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>