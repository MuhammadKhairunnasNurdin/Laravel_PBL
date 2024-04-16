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
            $table->foreignId('kader_id')->constrained('kaders', 'kader_id');
            $table->foreignId('NIK')->constrained('penduduks', 'NIK');
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
