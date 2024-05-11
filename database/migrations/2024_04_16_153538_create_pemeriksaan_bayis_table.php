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
        Schema::create('pemeriksaan_bayis', function (Blueprint $table) {
            $table->foreignId('pemeriksaan_id')->primary()->constrained('pemeriksaans', 'pemeriksaan_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('lingkar_kepala')->nullable();
            $table->float('lingkar_lengan')->nullable();
            $table->enum('asi', ['iya', 'tidak'])->nullable();
            $table->enum('kenaikan', ['iya', 'tidak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_bayis');
    }
};
