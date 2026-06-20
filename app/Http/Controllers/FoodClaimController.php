<?php

namespace App\Http\Controllers;

use App\Models\FoodClaimSfwr;
use App\Models\FoodItemSfwr;
use Illuminate\Http\Request;

class FoodClaimController extends Controller
{
    public function store(Request $request, $foodId)
    {
        FoodItemSfwr::findOrFail($foodId);

        $existing = FoodClaimSfwr::where('id_food_sfwr', $foodId)
            ->where('id_user_sfwr', auth()->id())
            ->where('status_sfwr', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already requested this item.');
        }

        FoodClaimSfwr::create([
            'id_food_sfwr' => $foodId,
            'id_user_sfwr' => auth()->id(),
            'status_sfwr' => 'pending',
            'claimed_at' => now(),
        ]);

        return back()->with('success', 'Request submitted. Waiting for admin approval.');
    }

    public function adminIndex()
    {
        $claims = FoodClaimSfwr::with('foodItem', 'user')
            ->where('status_sfwr', 'pending')
            ->orderBy('claimed_at', 'asc')
            ->get();

        return view('admin.pending-food', compact('claims'));
    }

    public function approve($id)
    {
        $claim = FoodClaimSfwr::findOrFail($id);
        $claim->update(['status_sfwr' => 'approved']);

        FoodClaimSfwr::where('id_food_sfwr', $claim->id_food_sfwr)
            ->where('id_claim_sfwr', '!=', $claim->id_claim_sfwr)
            ->where('status_sfwr', 'pending')
            ->update(['status_sfwr' => 'rejected']);

        return back()->with('success', 'Claim approved.');
    }

    public function reject($id)
    {
        FoodClaimSfwr::findOrFail($id)->update(['status_sfwr' => 'rejected']);
        return back()->with('success', 'Claim rejected.');
    }

    public function myClaims()
    {
        $claims = FoodClaimSfwr::with('foodItem')
            ->where('id_user_sfwr', auth()->id())
            ->orderBy('claimed_at', 'desc')
            ->get();

        return view('User.foods.myfoods', compact('claims'));
    }
}