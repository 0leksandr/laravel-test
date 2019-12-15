<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSentToMails extends Migration
{
    public function up(): void
    {
        Schema::table('mails', static function (Blueprint $table) {
            $table->boolean('sent')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('mails', static function (Blueprint $table) {
            $table->dropColumn('sent');
        });
    }
}
