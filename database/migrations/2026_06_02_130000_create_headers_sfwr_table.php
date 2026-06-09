<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('headers_sfwr')) {
            Schema::create('headers_sfwr', function (Blueprint $table) {
                $table->id('id_header_sfwr');
                $table->string('page_type_sfwr')->default('admin');
                $table->string('heading_sfwr');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('headers_sfwr');
    }
};