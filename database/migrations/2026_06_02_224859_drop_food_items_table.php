<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('food_items');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Food items table is no longer needed - replaced by fooditems_sfwr - migration is one-way
    }
};
