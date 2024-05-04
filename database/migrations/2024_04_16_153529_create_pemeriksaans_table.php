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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id('pemeriksaan_id');
            $table->unsignedBigInteger('kader_id')->index()->nullable();
            $table->foreign('kader_id')->references('kader_id')->on('kaders')->cascadeOnUpdate();
            $table->foreignId('penduduk_id')->constrained('penduduks', 'penduduk_id')->cascadeOnUpdate();
            $table->date('tgl_pemeriksaan')->nullable();
            $table->enum('golongan', ['bayi', 'lansia'])->nullable();
            $table->float('berat_badan')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->enum('status', ['sakit', 'sehat'])->nullable();
            $table->text('respon')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
