<?php

namespace App\Http\Controllers;

use App\Models\FoodIntakeSfwr;
use App\Models\FoodItemSfwr;
use Illuminate\Http\Request;

class FoodIntakeController extends Controller
{
    /**
     * Store a new food intake record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'foodintake_sfwr' => 'required|string|max:255',
            'id_food_sfwr' => 'required|exists:FoodItems_sfwr,id_food_sfwr',
            'notes_sfwr' => 'nullable|string',
        ]);

        $foodItem = FoodItemSfwr::findOrFail($validated['id_food_sfwr']);

        $intake = FoodIntakeSfwr::create([
            'foodintake_sfwr' => $validated['foodintake_sfwr'],
            'id_user_sfwr' => auth()->id(),
            'intake_date_sfwr' => now()->toDateString(),
            'notes_sfwr' => $validated['notes_sfwr'] ?? null,
        ]);

        // Update food item to link with intake record
        $foodItem->update(['id_intake_sfwr' => $intake->id_intake_sfwr]);

        return response()->json([
            'success' => true,
            'message' => 'Food intake recorded successfully',
            'data' => $intake,
        ]);
    }

    /**
     * Get all food intake records for the logged-in user
     */
    public function userIntakes()
    {
        $intakes = FoodIntakeSfwr::where('id_user_sfwr', auth()->id())
            ->with('foodItems')
            ->orderBy('intake_date_sfwr', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $intakes,
        ]);
    }

    /**
     * Get all food intake records (admin view)
     */
    public function index()
    {
        $intakes = FoodIntakeSfwr::with('user', 'foodItems')
            ->orderBy('intake_date_sfwr', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $intakes,
        ]);
    }

    /**
     * Get foods expiring soon
     */
    public function expiringFoods()
    {
        $expiringFoods = FoodItemSfwr::expiringWithin(7)
            ->with('foodIntake')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $expiringFoods->count(),
            'data' => $expiringFoods,
        ]);
    }

    /**
     * Get foods already consumed
     */
    public function consumedFoods()
    {
        $consumed = FoodIntakeSfwr::with('foodItems', 'user')
            ->where('id_user_sfwr', auth()->id())
            ->orderBy('intake_date_sfwr', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $consumed->count(),
            'data' => $consumed,
        ]);
    }

    /**
     * Update intake record
     */
    public function update(Request $request, $id)
    {
        $intake = FoodIntakeSfwr::findOrFail($id);

        // Authorization check
        if ($intake->id_user_sfwr !== auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $validated = $request->validate([
            'foodintake_sfwr' => 'sometimes|string|max:255',
            'notes_sfwr' => 'nullable|string',
        ]);

        $intake->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Intake record updated successfully',
            'data' => $intake,
        ]);
    }

    /**
     * Delete intake record
     */
    public function destroy($id)
    {
        $intake = FoodIntakeSfwr::findOrFail($id);

        // Authorization check
        if ($intake->id_user_sfwr !== auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        // Remove the link from food items
        FoodItemSfwr::where('id_intake_sfwr', $intake->id_intake_sfwr)
            ->update(['id_intake_sfwr' => null]);

        $intake->delete();

        return response()->json([
            'success' => true,
            'message' => 'Intake record deleted successfully',
        ]);
    }
}
