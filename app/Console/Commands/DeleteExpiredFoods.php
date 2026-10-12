<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:delete-expired-foods')]
#[Description('Delete food listings whose expiry date has passed')]
class DeleteExpiredFoods extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = 0;
        $today = now()->toDateString();

        // Delete through Eloquent so FoodItemSfwr's model events can remove
        // the associated intake record for each listing.
        \App\Models\FoodItemSfwr::query()
            ->whereDate('expiry_date_sfwr', '<', $today)
            ->chunkById(100, function ($foods) use (&$deleted): void {
                foreach ($foods as $food) {
                    $food->delete();
                    $deleted++;
                }
            }, 'id_food_sfwr');

        $this->info("Deleted {$deleted} expired food listing(s).");

        return self::SUCCESS;
    }
}
