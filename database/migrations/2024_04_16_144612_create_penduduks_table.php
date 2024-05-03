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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->string('NIK')->primary();
            $table->string('NKK')->nullable();
            $table->string('nama', 100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('pendapatan', ['0 - 500000', '500000 - 1000000', '1000000 - 2000000', '2000000 - 3000000', '3000000 - keatas'])->nullable();
            $table->string('no_telp', 14)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA', 'S1'])->nullable();
            $table->enum('hubungan_keluarga', ['Kepala Keluarga', 'Istri', 'Anak'])->nullable();
            $table->string('alamat', 200)->nullable();
            $table->enum('RT', ['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
