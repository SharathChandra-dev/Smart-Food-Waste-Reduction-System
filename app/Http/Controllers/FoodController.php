<?php

namespace App\Http\Controllers;

use App\Models\FoodItemSfwr;
use App\Models\FoodClaimSfwr;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function adminIndex()
    {
        $foodItems = FoodItemSfwr::orderBy('id_food_sfwr', 'desc')->get();

        return view('Admin.fooditems', compact('foodItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foodname_sfwr' => 'required|string|max:255',
            'foodcategory_sfwr' => 'required|string|max:255',
            'foodquantity_sfwr' => 'required|integer|min:1',
            'available_till_sfwr' => 'required|date|after:now',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        FoodItemSfwr::create([
            'foodname_sfwr' => $request->foodname_sfwr,
            'foodcategory_sfwr' => $request->foodcategory_sfwr,
            'manufacturing_date_sfwr' => $request->manufacturing_date_sfwr,
            'expiry_date_sfwr' => $request->expiry_date_sfwr,
            'foodquantity_sfwr' => $request->foodquantity_sfwr,
            'calories_sfwr' => $request->calories_sfwr,
            'fooddescription_sfwr' => $request->fooddescription_sfwr,
            'contact_sfwr' => $request->contact_sfwr,
            'pickup_location_sfwr' => $request->pickup_location_sfwr,
            'available_till_sfwr' => date('Y-m-d H:i:s', strtotime($request->available_till_sfwr)),
            'foodimage_sfwr' => $imagePath,
            'id_user_sfwr' => auth()->id(),
        ]);

        return back()->with('success', 'Food Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $food = FoodItemSfwr::findOrFail($id);

        if ($request->hasFile('image')) {
            $food->foodimage_sfwr = $request->file('image')->store('foods', 'public');
        }

        $food->update([
            'foodname_sfwr' => $request->foodname_sfwr,
            'foodcategory_sfwr' => $request->foodcategory_sfwr,
            'manufacturing_date_sfwr' => $request->manufacturing_date_sfwr,
            'expiry_date_sfwr' => $request->expiry_date_sfwr,
            'foodquantity_sfwr' => $request->foodquantity_sfwr,
            'calories_sfwr' => $request->calories_sfwr,
            'fooddescription_sfwr' => $request->fooddescription_sfwr,
            'contact_sfwr' => $request->contact_sfwr,
            'pickup_location_sfwr' => $request->pickup_location_sfwr,
            'available_till_sfwr' => $request->available_till_sfwr,
        ]);

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

        return view('User.foods.index', compact('foods', 'categories', 'myClaims'));
    }
}