<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cerberus_saved_templates', function (Blueprint $table) {
            $table->boolean('is_default')->default(false)->after('blocks');
        });

        // Marcar la plantilla "Default Template" como default
        DB::table('cerberus_saved_templates')
            ->where('name', 'Default Template')
            ->update(['is_default' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cerberus_saved_templates', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
};
