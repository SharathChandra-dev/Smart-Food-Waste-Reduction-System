<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FoodItemSfwr;
use App\Models\FoodIntakeSfwr;

class FoodIntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all food items that don't have an intake record yet
        $foodItems = FoodItemSfwr::where('id_intake_sfwr', null)->get();

        if ($foodItems->isEmpty()) {
            // If no food items exist, create sample ones first
            $this->createSampleFoodItems();
            $foodItems = FoodItemSfwr::where('id_intake_sfwr', null)->get();
        }

        // Create food intake records for each food item
        foreach ($foodItems as $food) {
            $intake = FoodIntakeSfwr::create([
                'foodintake_sfwr' => $food->foodname_sfwr,
                'id_user_sfwr' => $food->id_user_sfwr,
                'intake_date_sfwr' => now()->toDateString(),
                'notes_sfwr' => "Food intake record for {$food->foodname_sfwr} - Expires on {$food->expiry_date_sfwr}",
            ]);

            // Link the food item to this intake record
            $food->update(['id_intake_sfwr' => $intake->id_intake_sfwr]);

            $this->command->info("Created intake record for: {$food->foodname_sfwr}");
        }
    }

    /**
     * Create sample food items if none exist
     */
    private function createSampleFoodItems(): void
    {
        $users = DB::table('users_sfwr')->pluck('id')->toArray();

        if (empty($users)) {
            $this->command->warn("No users found in users_sfwr table. Please create users first.");
            return;
        }

        $sampleFoods = [
            [
                'foodname_sfwr' => 'Organic Milk',
                'foodcategory_sfwr' => 'Dairy',
                'manufacturing_date_sfwr' => now()->subDays(2)->toDateString(),
                'expiry_date_sfwr' => now()->addDays(5)->toDateString(),
                'foodquantity_sfwr' => 10,
                'calories_sfwr' => 150,
                'fooddescription_sfwr' => 'Fresh organic milk from local dairy',
                'contact_sfwr' => '123456789',
                'pickup_location_sfwr' => 'Downtown Store',
                'available_till_sfwr' => now()->addDays(5)->toDateTimeString(),
                'id_user_sfwr' => $users[array_rand($users)],
            ],
            [
                'foodname_sfwr' => 'Fresh Vegetables',
                'foodcategory_sfwr' => 'Vegetables',
                'manufacturing_date_sfwr' => now()->subDays(1)->toDateString(),
                'expiry_date_sfwr' => now()->addDays(7)->toDateString(),
                'foodquantity_sfwr' => 20,
                'calories_sfwr' => 45,
                'fooddescription_sfwr' => 'Mixed fresh vegetables from farm',
                'contact_sfwr' => '987654321',
                'pickup_location_sfwr' => 'Central Market',
                'available_till_sfwr' => now()->addDays(7)->toDateTimeString(),
                'id_user_sfwr' => $users[array_rand($users)],
            ],
            [
                'foodname_sfwr' => 'Whole Wheat Bread',
                'foodcategory_sfwr' => 'Bakery',
                'manufacturing_date_sfwr' => now()->toDateString(),
                'expiry_date_sfwr' => now()->addDays(3)->toDateString(),
                'foodquantity_sfwr' => 15,
                'calories_sfwr' => 250,
                'fooddescription_sfwr' => 'Freshly baked whole wheat bread',
                'contact_sfwr' => '555666777',
                'pickup_location_sfwr' => 'Bakery Shop',
                'available_till_sfwr' => now()->addDays(3)->toDateTimeString(),
                'id_user_sfwr' => $users[array_rand($users)],
            ],
        ];

        foreach ($sampleFoods as $food) {
            FoodItemSfwr::create($food);
            $this->command->info("Created sample food item: {$food['foodname_sfwr']}");
        }
    }
}
