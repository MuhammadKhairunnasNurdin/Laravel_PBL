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
        Schema::create('audit_bulanan_lansias', function (Blueprint $table) {
            $table->foreignId('penduduk_id')->primary()->constrained('penduduks', 'penduduk_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('berat_badan', 6, 3);
            $table->float('tinggi_badan', 6, 3);
            $table->float('lingkar_perut', 6, 3);
            $table->integer('gula_darah');
            $table->integer('kolesterol');
            $table->integer('tensi_darah');
            $table->float('asam_urat', 6, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_bulanan_lansias');
    }
};
