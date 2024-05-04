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
        Schema::create('pemeriksaan_lansias', function (Blueprint $table) {
            $table->foreignId('pemeriksaan_id')->primary()->constrained('pemeriksaans', 'pemeriksaan_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('lingkar_perut')->nullable();
            $table->integer('gula_darah')->nullable();
            $table->integer('kolesterol')->nullable();
            $table->integer('tensi_darah')->nullable();
            $table->float('asam_urat')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_lansias');
    }
};
