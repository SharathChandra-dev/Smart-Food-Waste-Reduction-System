<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('FoodItems_sfwr', function (Blueprint $table) {

            $table->id('id_food_sfwr');

            $table->string('foodname_sfwr');

            $table->string('foodcategory_sfwr')->nullable();

            $table->date('manufacturing_date_sfwr');

            $table->date('expiry_date_sfwr');

            $table->integer('foodquantity_sfwr');

            $table->integer('calories_sfwr');

            $table->text('fooddescription_sfwr')->nullable();

            $table->string('contact_sfwr');

            $table->string('pickup_location_sfwr');

            $table->dateTime('available_till_sfwr');

            $table->string('foodimage_sfwr')->nullable();

            $table->unsignedBigInteger('id_user_sfwr')->nullable();

            $table->unsignedBigInteger('id_intake_sfwr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('FoodItems_sfwr');
    }
};