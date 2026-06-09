<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('FoodItems_sfwr')) {
            return;
        }

        Schema::table('FoodItems_sfwr', function (Blueprint $table) {
            if (!Schema::hasColumn('FoodItems_sfwr', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('id_intake_sfwr');
            }
            if (!Schema::hasColumn('FoodItems_sfwr', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('FoodItems_sfwr')) {
            return;
        }

        Schema::table('FoodItems_sfwr', function (Blueprint $table) {
            if (Schema::hasColumn('FoodItems_sfwr', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
            if (Schema::hasColumn('FoodItems_sfwr', 'created_at')) {
                $table->dropColumn('created_at');
            }
        });
    }
};
