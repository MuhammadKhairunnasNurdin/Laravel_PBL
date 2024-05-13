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
        /**
         * if we had logic to delete data in this table, if data is used by
         * other table, we must not delete that data, but just give null in \
         * NKK column, else scenario like
         * we're dealing with useless data or data that not used by other
         * table, we can delete that
         */
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id('penduduk_id');
            $table->string('NIK', 20)->unique();
            $table->string('NKK', 20);
            $table->string('nama', 100);
            $table->date('tgl_lahir');
            $table->enum('pendapatan', ['0 - 500000', '500000 - 1000000', '1000000 - 2000000', '2000000 - 3000000', '3000000 - keatas'])->nullable();
            $table->string('no_telp', 14)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('pendidikan', ['Tidak Terpelajar','SD', 'SMP', 'SMA', 'S1'])->nullable();
            $table->enum('hubungan_keluarga', ['Kepala Keluarga', 'Istri', 'Anak']);
            $table->string('alamat', 200);
            $table->enum('RT', ['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06']);
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
