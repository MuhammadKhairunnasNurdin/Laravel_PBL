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
        Schema::create('bantuan_pangans', function (Blueprint $table) {
            $table->id('bp_id');
            $table->foreignId('penduduk_id')->constrained('penduduks', 'penduduk_id')->cascadeOnUpdate();
            $table->string('periode_bantuan')->nullable();
            $table->string('jenis_bantuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan_pangans');
    }
};
