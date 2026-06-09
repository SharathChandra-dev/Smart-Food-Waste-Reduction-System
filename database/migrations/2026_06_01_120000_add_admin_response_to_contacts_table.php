<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->longText('admin_response_sfwr')->nullable()->after('message_sfwr');
            $table->timestamp('replied_at_sfwr')->nullable()->after('admin_response_sfwr');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['admin_response_sfwr', 'replied_at_sfwr']);
        });
    }
};
