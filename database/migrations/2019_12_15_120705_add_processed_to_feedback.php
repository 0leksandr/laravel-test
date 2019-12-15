<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessedToFeedback extends Migration
{
    public function up(): void
    {
        Schema::table('feedback', static function (Blueprint $table) {
            $table->boolean('processed')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('feedback', static function (Blueprint $table) {
            $table->dropColumn('processed');
        });
    }
}
