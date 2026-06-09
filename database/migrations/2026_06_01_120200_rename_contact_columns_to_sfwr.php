<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts_new', function (Blueprint $table) {
            $table->id();
            $table->string('name_sfwr');
            $table->string('email_sfwr');
            $table->string('subject_sfwr');
            $table->longText('message_sfwr');
            $table->longText('admin_response_sfwr')->nullable();
            $table->timestamp('replied_at_sfwr')->nullable();
            $table->timestamps();
        });

        $hasNew = Schema::hasColumn('contacts', 'name_sfwr');
        $hasOld = Schema::hasColumn('contacts', 'name');
        $hasOldResponse = Schema::hasColumn('contacts', 'admin_response');
        $hasOldReplied = Schema::hasColumn('contacts', 'replied_at');

        $contacts = DB::table('contacts')->get();

        foreach ($contacts as $contact) {
            DB::table('contacts_new')->insert([
                'id' => $contact->id,
                'name_sfwr' => $hasNew ? $contact->name_sfwr : $contact->name,
                'email_sfwr' => $hasNew ? $contact->email_sfwr : $contact->email,
                'subject_sfwr' => $hasNew ? $contact->subject_sfwr : $contact->subject,
                'message_sfwr' => $hasNew ? $contact->message_sfwr : $contact->message,
                'admin_response_sfwr' => $hasNew ? ($contact->admin_response_sfwr ?? null) : ($hasOldResponse ? $contact->admin_response : null),
                'replied_at_sfwr' => $hasNew ? ($contact->replied_at_sfwr ?? null) : ($hasOldReplied ? $contact->replied_at : null),
                'created_at' => $contact->created_at,
                'updated_at' => $contact->updated_at,
            ]);
        }

        Schema::drop('contacts');
        Schema::rename('contacts_new', 'contacts');
    }

    public function down(): void
    {
        Schema::create('contacts_old', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->longText('message');
            $table->longText('admin_response')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });

        $hasNew = Schema::hasColumn('contacts', 'name_sfwr');
        $hasOld = Schema::hasColumn('contacts', 'name');
        $hasNewResponse = Schema::hasColumn('contacts', 'admin_response_sfwr');
        $hasNewReplied = Schema::hasColumn('contacts', 'replied_at_sfwr');

        $contacts = DB::table('contacts')->get();

        foreach ($contacts as $contact) {
            DB::table('contacts_old')->insert([
                'id' => $contact->id,
                'name' => $hasNew ? $contact->name_sfwr : ($hasOld ? $contact->name : null),
                'email' => $hasNew ? $contact->email_sfwr : ($hasOld ? $contact->email : null),
                'subject' => $hasNew ? $contact->subject_sfwr : ($hasOld ? $contact->subject : null),
                'message' => $hasNew ? $contact->message_sfwr : ($hasOld ? $contact->message : null),
                'admin_response' => $hasNewResponse ? ($contact->admin_response_sfwr ?? null) : null,
                'replied_at' => $hasNewReplied ? ($contact->replied_at_sfwr ?? null) : null,
                'created_at' => $contact->created_at,
                'updated_at' => $contact->updated_at,
            ]);
        }

        Schema::drop('contacts');
        Schema::rename('contacts_old', 'contacts');
    }
};
