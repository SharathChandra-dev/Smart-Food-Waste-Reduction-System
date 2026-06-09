<?php

namespace App\Http\Controllers;

use App\Models\HeaderSfwr;
use App\Models\FoodItemSfwr;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.admin');
    }

    public function register()
    {
        return view('User.register');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalFoods = FoodItemSfwr::count();
        $totalHeaders = HeaderSfwr::count();

        $today = Carbon::today()->toDateString();
        $soonDate = Carbon::today()->addDays(7)->toDateString();

        $expiringFoods = FoodItemSfwr::whereDate('expiry_date_sfwr', '>=', $today)
            ->whereDate('expiry_date_sfwr', '<=', $soonDate)
            ->orderBy('expiry_date_sfwr', 'asc')
            ->get();

        $totalExpiringSoon = $expiringFoods->count();

        return view('admin.admin_dashboard', compact('totalUsers', 'totalFoods', 'totalHeaders', 'totalExpiringSoon', 'expiringFoods'));
    }

    public function users()
    {
        $users = User::select('id_user_sfwr', 'username_sfwr', 'email_sfwr', 'role_sfwr', 'created_at')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id_user_sfwr,
                    'name' => $user->username_sfwr,
                    'email' => $user->email_sfwr,
                    'role' => $user->role_sfwr,
                    'created_at' => $user->created_at ?? null,
                ];
            });

        return view('admin.admin_users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users_sfwr,email_sfwr',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Admin,User',
        ]);

        User::create([
            'username_sfwr' => $request->name,
            'email_sfwr' => $request->email,
            'password_sfwr' => Hash::make($request->password),
            'role_sfwr' => $request->role,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users_sfwr,email_sfwr,' . $id . ',id_user_sfwr',
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:Admin,User',
        ]);

        $user->username_sfwr = $request->name;
        $user->email_sfwr = $request->email;
        $user->role_sfwr = $request->role;

        if ($request->filled('password')) {
            $user->password_sfwr = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function foodItems()
    {
        $foodItems = [];
        return view('admin.fooditems', compact('foodItems'));
    }

    public function pendingFood()
    {
        return view('admin.pending-food');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

     /* -----------------------------
        HEADER CRUD (NEW FEATURE)
    ------------------------------*/

    public function headers()
    {
        $headers = HeaderSfwr::all();
        return view('admin.admin_headers', compact('headers'));
    }

    public function storeHeader(Request $request)
    {
        $request->validate([
            'page_type' => 'required|in:admin,user',
            'heading' => 'required|string|max:255',
        ]);

        HeaderSfwr::create([
            'page_type_sfwr' => $request->page_type,
            'heading_sfwr' => $request->heading,
        ]);

        return back()->with('success', 'Header added successfully.');
    }

    public function updateHeader(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
        ]);

        $header = HeaderSfwr::findOrFail($id);

        $header->update([
            'heading_sfwr' => $request->heading,
        ]);

        return back()->with('success', 'Header updated successfully.');
    }

    public function deleteHeader($id)
    {
        $header = HeaderSfwr::findOrFail($id);
        $header->delete();

        return back()->with('success', 'Header deleted successfully.');
    }

}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class AdminController extends Controller
// {
//     public function login(Request $request)
//     {
//         $request->validate([
//             'admin_id' => 'required',
//             'password' => 'required',
//         ]);

//         if ($request->admin_id === 'admin' && $request->password === 'admin123') {
//             $request->session()->put('is_admin', true);
//             $request->session()->save();
//             return redirect()->route('admin.dashboard');
//         }

//         return back()->withErrors(['admin_id' => 'Invalid admin credentials.']);
//     }

//     public function dashboard(Request $request)
//     {
//         if (!$request->session()->get('is_admin')) {
//             return redirect()->route('admin.login');
//         }

//         $users = DB::table('users_sfwr')->get();

//         return view('admin.admin_dashboard', compact('users'));
//     }

//     public function logout(Request $request)
//     {
//         $request->session()->forget('is_admin');
//         return redirect()->route('admin.login');
//     }
// }
