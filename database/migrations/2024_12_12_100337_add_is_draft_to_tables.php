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
        $tables = ['prd_daily_foreman_daily_report', 'prd_daily_foreman_front_loading', 'prd_daily_foreman_alat_support', 'prd_daily_foreman_note'];
        foreach($tables as $table){
            Schema::table($table, function (Blueprint $table) {
                $table->boolean('is_draft')->default(0);
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['prd_daily_foreman_daily_report', 'prd_daily_foreman_front_loading', 'prd_daily_foreman_alat_support', 'prd_daily_foreman_note'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('IsDraft');
            });
        }
    }
};
