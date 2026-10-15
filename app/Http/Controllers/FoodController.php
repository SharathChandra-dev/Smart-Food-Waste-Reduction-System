<?php


namespace App\Http\Controllers;

use App\Models\FoodItemSfwr;
use App\Models\FoodClaimSfwr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function adminIndex()
    {
        $expiredView = request()->query('status') === 'expired';
        $foodItems = FoodItemSfwr::query()
            ->when($expiredView,
                fn ($query) => $query->whereDate('expiry_date_sfwr', '<', now()->toDateString()),
                fn ($query) => $query->where(function ($query) {
                    $query->whereNull('expiry_date_sfwr')
                        ->orWhereDate('expiry_date_sfwr', '>=', now()->toDateString());
                })
            )
            ->orderBy('id_food_sfwr', 'desc')
            ->get();
        $foodCounts = [
            'active' => FoodItemSfwr::where(function ($query) {
                $query->whereNull('expiry_date_sfwr')
                    ->orWhereDate('expiry_date_sfwr', '>=', now()->toDateString());
            })->count(),
            'expired' => FoodItemSfwr::whereDate('expiry_date_sfwr', '<', now()->toDateString())->count(),
        ];

        return view('Admin.fooditems', compact('foodItems', 'foodCounts', 'expiredView'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foodname_sfwr' => 'required|string|max:255',
            'foodcategory_sfwr' => 'required|string|max:255',
            'manufacturing_date_sfwr' => 'required|date',
            'expiry_date_sfwr' => 'required|date|after_or_equal:manufacturing_date_sfwr',
            'foodquantity_sfwr' => 'required|integer|min:1',
            'calories_sfwr' => 'required|integer|min:0',
            'fooddescription_sfwr' => 'nullable|string',
            'contact_sfwr' => 'required|string|max:255',
            'pickup_location_sfwr' => 'required|string|max:255',
            'available_till_sfwr' => 'required|date|after:now',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        FoodItemSfwr::create([
            ...$validated,
            'available_till_sfwr' => date('Y-m-d H:i:s', strtotime($validated['available_till_sfwr'])),
            'foodimage_sfwr' => $imagePath,
            'id_user_sfwr' => auth()->id(),
        ]);

        return back()->with('success', 'Food Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $food = FoodItemSfwr::findOrFail($id);
        $validated = $request->validate([
            'foodname_sfwr' => 'required|string|max:255',
            'foodcategory_sfwr' => 'required|string|max:255',
            'manufacturing_date_sfwr' => 'required|date',
            'expiry_date_sfwr' => 'required|date|after_or_equal:manufacturing_date_sfwr',
            'foodquantity_sfwr' => 'required|integer|min:1',
            'calories_sfwr' => 'required|integer|min:0',
            'fooddescription_sfwr' => 'nullable|string',
            'contact_sfwr' => 'required|string|max:255',
            'pickup_location_sfwr' => 'required|string|max:255',
            'available_till_sfwr' => 'required|date|after:now',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['foodimage_sfwr'] = $request->file('image')->store('foods', 'public');
        }

        $food->update($validated);

        return back()->with('success', 'Food Updated');
    }

    public function destroy($id)
    {
        FoodItemSfwr::findOrFail($id)->delete();

        return back()->with('success', 'Food Deleted');
    }

    public function userIndex(Request $request)
    {
        $query = FoodItemSfwr::whereDate('expiry_date_sfwr', '>=', now()->toDateString());

        if ($request->filled('search')) {
            $query->where('foodname_sfwr', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('foodcategory_sfwr', $request->category);
        }

        $foods = $query->orderBy('expiry_date_sfwr', 'asc')->get();

        $categories = FoodItemSfwr::select('foodcategory_sfwr')
            ->distinct()
            ->whereNotNull('foodcategory_sfwr')
            ->pluck('foodcategory_sfwr');

        $myClaims = FoodClaimSfwr::where('id_user_sfwr', auth()->id())
            ->whereIn('id_food_sfwr', $foods->pluck('id_food_sfwr'))
            ->pluck('status_sfwr', 'id_food_sfwr');

        $creditFile = 'foods/demo-catalog/credits.json';
        $foodImageCredits = Storage::disk('public')->exists($creditFile)
            ? (json_decode(Storage::disk('public')->get($creditFile), true) ?: [])
            : [];

        return view('User.foods.index', compact('foods', 'categories', 'myClaims', 'foodImageCredits'));
    }
}
