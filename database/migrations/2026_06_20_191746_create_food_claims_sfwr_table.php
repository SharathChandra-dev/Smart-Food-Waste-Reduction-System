<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_claims_sfwr', function (Blueprint $table) {
            $table->id('id_claim_sfwr');
            $table->unsignedBigInteger('id_food_sfwr');
            $table->integer('id_user_sfwr');
            $table->enum('status_sfwr', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('claimed_at')->useCurrent();
            $table->timestamps();

            $table->foreign('id_food_sfwr')->references('id_food_sfwr')->on('FoodItems_sfwr')->onDelete('cascade');
            $table->foreign('id_user_sfwr')->references('id_user_sfwr')->on('users_sfwr')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_claims_sfwr');
    }
};