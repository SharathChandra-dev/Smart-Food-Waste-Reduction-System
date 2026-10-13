<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $itemsPath = __DIR__ . '/data/food_catalog.json';
        $items = json_decode(file_get_contents($itemsPath), true, flags: JSON_THROW_ON_ERROR);
        $today = Carbon::today();
        $now = now();
        $contact = '+49 155 10323692';
        $location = 'SRH Campus Munich';

        foreach ($items as $item) {
            $credit = $item['photo_credit'];
            $description = sprintf(
                'Sample catalog listing. Photo: %s, “%s” (%s). Source: %s',
                $credit['author'],
                $credit['title'],
                $credit['license'],
                $credit['source_url']
            );

            DB::table('FoodItems_sfwr')->updateOrInsert(
                [
                    'foodname_sfwr' => $item['foodname_sfwr'],
                    'fooddescription_sfwr' => $description,
                    'contact_sfwr' => $contact,
                ],
                [
                    'foodcategory_sfwr' => $item['foodcategory_sfwr'],
                    'manufacturing_date_sfwr' => $today->copy()->subDay()->toDateString(),
                    'expiry_date_sfwr' => $today->copy()->addDays($item['expiry_days'])->toDateString(),
                    'foodquantity_sfwr' => $item['foodquantity_sfwr'],
                    'calories_sfwr' => $item['calories_sfwr'],
                    'contact_sfwr' => $contact,
                    'pickup_location_sfwr' => $location,
                    'available_till_sfwr' => $now->copy()->addDays(3)->endOfDay(),
                    'foodimage_sfwr' => $item['foodimage_sfwr'],
                    'id_user_sfwr' => null,
                    'id_intake_sfwr' => null,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }

        $this->command?->info('Loaded 30 sample food listings with local, attributed images.');
    }
}
