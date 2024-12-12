<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToCerberusSavedBlocks extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cerberus_saved_blocks', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cerberus_saved_blocks', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
