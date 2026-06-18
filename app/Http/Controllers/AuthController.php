<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserTwoFactor;
use App\Services\Google2faService;

class AuthController extends Controller
{
    public function login(Request $request)
    {
 $request->validate([
'password' => 'required|string',
'username' => 'required|string',
]);

$user = User::where('username_sfwr', $request->username)->first();

if (!$user) {
    return back()->withErrors([
        'username' => 'User not found.'
    ])->withInput();
}

if ($user->role_sfwr !== 'User') {
    return back()->withErrors([
        'username' => 'This account belongs to an Admin. Please use Admin Login.'
    ])->withInput();
}

if (!Hash::check($request->password, $user->password_sfwr)) {
    return back()->withErrors([
        'password' => 'Invalid password.'
    ])->withInput();
}

Auth::login($user);

$request->session()->regenerate();

$twoFactor = UserTwoFactor::where('user_id_sfwr', $user->id_user_sfwr)->first();

if ($twoFactor && $twoFactor->enabled_sfwr) {
    Auth::logout();
    session(['2fa_user_id' => $user->id_user_sfwr]);
    return redirect()->route('2fa.verify');
}

return redirect()->route('2fa.setup');
    }

    public function show2faSetup()
    {
        $user = Auth::user();

        $twoFactor = UserTwoFactor::firstOrNew(['user_id_sfwr' => $user->id_user_sfwr]);

        if (!$twoFactor->secret_base32_sfwr) {
            $twoFactor->secret_base32_sfwr = Google2faService::generateSecretKey();
            $twoFactor->enabled_sfwr = false;
            $twoFactor->save();
        }

        $qrUrl = Google2faService::getOtpAuthUrl('SFWR', $user->username_sfwr, $twoFactor->secret_base32_sfwr);

        return view('2fa.setup', [
            'user' => $user,
            'twoFactor' => $twoFactor,
            'qrUrl' => $qrUrl,
        ]);
    }

    public function regenerate2faSecret(Request $request)
    {
        $request->validate([
            'regenerate' => 'nullable',
        ]);

        $user = Auth::user();
        $twoFactor = UserTwoFactor::firstOrNew(['user_id_sfwr' => $user->id_user_sfwr]);
        $twoFactor->secret_base32_sfwr = Google2faService::generateSecretKey();
        $twoFactor->enabled_sfwr = false;
        $twoFactor->save();

        return redirect()->route('2fa.setup')->with('success', '2FA QR code regenerated. Scan the new code with your authenticator app.');
    }

    public function verify2faSetup(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $twoFactor = UserTwoFactor::where('user_id_sfwr', $user->id_user_sfwr)->first();

        if (!$twoFactor || !Google2faService::verifyKey($twoFactor->secret_base32_sfwr, $request->code)) {
            return back()->withErrors(['code' => 'Invalid verification code.'])->withInput();
        }

        $twoFactor->enabled_sfwr = true;
        $twoFactor->save();

        return redirect()->route('dashboard')->with('success', 'Two-factor authentication enabled successfully.');
    }

    public function show2faVerify()
    {
        if (!session()->has('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('2fa.verify');
    }

    public function verify2faLogin(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $userId = session('2fa_user_id');
        $twoFactor = UserTwoFactor::where('user_id_sfwr', $userId)->where('enabled_sfwr', 1)->first();

        if (!$twoFactor || !Google2faService::verifyKey($twoFactor->secret_base32_sfwr, $request->code)) {
            return back()->withErrors(['code' => 'Invalid authentication code.'])->withInput();
        }

        session()->forget('2fa_user_id');
        Auth::loginUsingId($userId);
        session()->regenerate();

        $user = Auth::user();
        if ($user->role_sfwr === 'Admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('foods.index');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users_sfwr,email_sfwr',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'username_sfwr' => $request->name,
            'email_sfwr' => $request->email,
            'password_sfwr' => Hash::make($request->password),
            'role_sfwr' => 'User',
            'created_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

public function adminLogin(Request $request)
{
    $request->validate([
'username' => 'required|string',
'password' => 'required|string',
]);

$user = User::where('username_sfwr', $request->username)->first();

if (!$user) {
    return back()->withErrors([
        'username' => 'Admin account not found.'
    ])->withInput();
}

if ($user->role_sfwr !== 'Admin') {
    return back()->withErrors([
        'username' => 'This account belongs to a User. Please use User Login.'
    ])->withInput();
}

if (!Hash::check($request->password, $user->password_sfwr)) {
    return back()->withErrors([
        'password' => 'Invalid password.'
    ])->withInput();
}

Auth::login($user);

$request->session()->regenerate();

$twoFactor = UserTwoFactor::where('user_id_sfwr', $user->id_user_sfwr)->first();

if ($twoFactor && $twoFactor->enabled_sfwr) {
    Auth::logout();
    session(['2fa_user_id' => $user->id_user_sfwr]);
    return redirect()->route('2fa.verify');
}

return redirect()->route('2fa.setup');
}
}