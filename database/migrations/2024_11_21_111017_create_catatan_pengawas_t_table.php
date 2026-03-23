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
        Schema::create('prd_daily_foreman_note', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->string('daily_report_uuid')->index();
            $table->foreignId('daily_report_id')->constrained('prd_daily_foreman_daily_report');
            $table->boolean('statusenabled')->default(1);
            $table->time('jam_start')->nullable();
            $table->time('jam_stop')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prd_daily_foreman_note');
    }
};
