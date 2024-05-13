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
        Schema::create('rekam_medis_ibus', function (Blueprint $table) {
            $table->foreignId('ibu_id')->constrained('penduduks', 'penduduk_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('anak_id')->constrained('penduduks', 'penduduk_id')->cascadeOnUpdate();
            $table->primary(['ibu_id', 'anak_id']);
            $table->string('data_kb', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis_ibus');
    }
};
