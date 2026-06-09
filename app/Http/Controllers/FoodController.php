<?php

namespace App\Http\Controllers;

use App\Models\FoodItemSfwr;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function adminIndex()
    {
        $foodItems = FoodItemSfwr::orderBy('id_food_sfwr', 'desc')->get();

        return view(
            'Admin.fooditems',
            compact('foodItems')
        );
    }

    public function store(Request $request)
    {
        
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('foods', 'public');
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
            // 'available_till_sfwr' => $request->available_till_sfwr,
            'available_till_sfwr' => date('Y-m-d H:i:s', strtotime($request->available_till_sfwr)),
            'foodimage_sfwr' => $imagePath

        ]);
// added now
        $request->validate([
        'available_till_sfwr' => 'required|date|after:now',
        'foodname_sfwr' => 'required',
        'foodcategory_sfwr' => 'required',
        'foodquantity_sfwr' => 'required|integer',
]);

        return back()
            ->with('success', 'Food Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $food = FoodItemSfwr::findOrFail($id);

        if ($request->hasFile('image')) {

            $food->foodimage_sfwr =
                $request->file('image')
                ->store('foods', 'public');
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
            'available_till_sfwr' => $request->available_till_sfwr
        ]);

        return back()
            ->with('success', 'Food Updated');
    }

    public function destroy($id)
    {
        FoodItemSfwr::findOrFail($id)
            ->delete();

        return back()
            ->with('success', 'Food Deleted');
    }

    public function userIndex()
    {
        $foods = FoodItemSfwr::whereDate('expiry_date_sfwr', '>=', now()->toDateString())
            ->orderBy('id_food_sfwr', 'desc')
            ->get();

        return view(
            'User.foods.index',
            compact('foods')
        );
    }
}