<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodItemSfwr;
use Carbon\CarbonInterface;
use Illuminate\Http\JsonResponse;

class FoodApiController extends Controller
{
    public function index(): JsonResponse
    {
        $foods = FoodItemSfwr::whereDate('expiry_date_sfwr', '>=', now()->toDateString())
            ->orderBy('expiry_date_sfwr', 'asc')
            ->get()
            ->map(fn (FoodItemSfwr $food) => $this->formatFood($food));

        return response()->json([
            'success' => true,
            'count' => $foods->count(),
            'data' => $foods,
        ]);
    }

    public function show($id): JsonResponse
    {
        $food = FoodItemSfwr::where('id_food_sfwr', $id)->first();

        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food item not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatFood($food, true),
        ]);
    }

    private function formatFood(FoodItemSfwr $food, bool $includeManufacturingDate = false): array
    {
        $data = [
            'id_food_sfwr' => $food->id_food_sfwr,
            'foodname_sfwr' => $food->foodname_sfwr,
            'foodcategory_sfwr' => $food->foodcategory_sfwr,
            'expiry_date_sfwr' => $this->formatDate($food->expiry_date_sfwr),
            'foodquantity_sfwr' => $food->foodquantity_sfwr,
            'calories_sfwr' => $food->calories_sfwr,
            'fooddescription_sfwr' => $food->fooddescription_sfwr,
            'contact_sfwr' => $food->contact_sfwr,
            'pickup_location_sfwr' => $food->pickup_location_sfwr,
            'available_till_sfwr' => $this->formatDateTime($food->available_till_sfwr),
            'foodimage_sfwr' => $food->foodimage_sfwr,
            'expiry_status' => $food->expiry_status,
        ];

        if ($includeManufacturingDate) {
            $data = array_merge([
                'manufacturing_date_sfwr' => $this->formatDate($food->manufacturing_date_sfwr),
            ], $data);
        }

        return $data;
    }

    private function formatDate($value): ?string
    {
        if (!$value) {
            return null;
        }

        if ($value instanceof CarbonInterface) {
            return $value->toDateString();
        }

        return (string) $value;
    }

    private function formatDateTime($value): ?string
    {
        if (!$value) {
            return null;
        }

        if ($value instanceof CarbonInterface) {
            return $value->toDateTimeString();
        }

        return (string) $value;
    }
}
