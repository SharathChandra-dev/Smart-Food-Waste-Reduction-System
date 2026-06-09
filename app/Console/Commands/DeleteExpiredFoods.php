<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:delete-expired-foods')]
#[Description('Command description')]
class DeleteExpiredFoods extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
