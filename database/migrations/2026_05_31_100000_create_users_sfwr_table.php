<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_sfwr', function (Blueprint $table) {
            $table->integer('id_user_sfwr')->autoIncrement();
            $table->string('username_sfwr');
            $table->string('email_sfwr')->unique();
            $table->string('password_sfwr');
            $table->string('role_sfwr')->default('User');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_sfwr');
    }
};
