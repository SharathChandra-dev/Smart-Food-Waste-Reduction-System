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
    Schema::create('contacts', function (Blueprint $table) {

        $table->id();

        $table->string('name_sfwr');

        $table->string('email_sfwr');

        $table->string('subject_sfwr');

        $table->longText('message_sfwr');

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
