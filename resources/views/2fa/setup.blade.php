<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Setup</title>
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
                    <span>Two-Factor Authentication</span>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-badge">Security Setup</div>
                <h1>Enable 2FA</h1>
                <p>Scan the QR code below with your authenticator app and enter the code to activate two-factor authentication.</p>
            </div>
        </div>
        <div class="admin-right">
            <div class="admin-login-card">
                <div class="top-indicator"></div>
                <div class="login-header">
                    <div class="admin-icon"><i class="fa-solid fa-lock"></i></div>
                    <h2>Authenticator Setup</h2>
                    <p>Use Google Authenticator, Authy, or another TOTP app.</p>
                </div>
                @if(session('success'))
                    <div class="notification success" style="margin-bottom:1rem; padding:1rem; border-radius:0.75rem; background:#d1fae5; color:#065f46;">{{ session('success') }}</div>
                @endif
                <div class="setup-content" style="text-align:center; padding: 1rem;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ rawurlencode($qrUrl) }}" alt="2FA QR Code" style="max-width:300px; margin-bottom:1rem;" />
                    <p><strong>Secret key:</strong> {{ $twoFactor->secret_base32 }}</p>
                    <p style="font-size:0.9rem; color:#777;">If your app cannot scan the QR code, enter the secret manually.</p>
                    <textarea readonly style="width:100%; min-height:3rem; padding:0.75rem; margin-top:0.75rem; border-radius:0.5rem; border:1px solid #ddd; background:#fafafa;">{{ $qrUrl }}</textarea>
                    <form method="POST" action="{{ route('2fa.setup.regenerate') }}" style="margin-top:1rem; display:inline-block;">
                        @csrf
                        <button type="submit" class="admin-btn" style="background:#f59e0b; border:none;">Regenerate QR</button>
                    </form>
                </div>
                <form method="POST" action="{{ route('2fa.setup.verify') }}">
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
                        Enable 2FA
                    </button>
                </form>
                <div class="bottom-text" style="margin-top:24px; text-align:center;">
                    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
