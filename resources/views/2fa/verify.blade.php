<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Verification</title>
    @vite('resources/css/Admin/admin.css')
</head>
<body>
    <div class="bg-gradient"></div>
    <div class="admin-wrapper">
        <div class="admin-left">
            <div class="brand">
                <div class="brand-logo"><i class="fa-solid fa-shield-halved"></i></div>
                <div>
                    <h2>SFWR</h2>
                    <span>Two-Factor Verification</span>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-badge">Authentication Required</div>
                <h1>Enter Your Code</h1>
                <p>Enter the 6-digit code from your authenticator app to continue.</p>
            </div>
        </div>
        <div class="admin-right">
            <div class="admin-login-card">
                <div class="top-indicator"></div>
                <div class="login-header">
                    <div class="admin-icon"><i class="fa-solid fa-lock"></i></div>
                    <h2>Verify Login</h2>
                    <p>Complete the second step of your login.</p>
                </div>
                <form method="POST" action="{{ route('2fa.verify.submit') }}">
                    @csrf
                    <div class="input-group">
                        <label>Authentication Code</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-key"></i>
                            <input type="text" name="code" placeholder="Enter 6-digit code" value="{{ old('code') }}" required>
                        </div>
                        @error('code')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="admin-btn">
                        <i class="fa-solid fa-check"></i>
                        Verify Code
                    </button>
                </form>
                <div class="bottom-text" style="margin-top:24px; text-align:center;">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
