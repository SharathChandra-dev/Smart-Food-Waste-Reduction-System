<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foodintake_sfwr', function (Blueprint $table) {

            $table->bigIncrements('id_intake_sfwr');

            $table->string('foodintake_sfwr');

            $table->unsignedBigInteger('id_user_sfwr')->nullable();

            $table->date('intake_date_sfwr')->nullable();

            $table->text('notes_sfwr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foodintake_sfwr');
    }
};

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::create('FoodIntake_sfwr', function (Blueprint $table) {
//             $table->id('id_intake_sfwr');
//             $table->string('intake_name')->nullable();
//             $table->text('description')->nullable();
//             $table->timestamps();
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('FoodIntake_sfwr');
//     }
// };