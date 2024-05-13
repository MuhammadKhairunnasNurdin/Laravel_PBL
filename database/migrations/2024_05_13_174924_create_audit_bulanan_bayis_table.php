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
        Schema::create('audit_bulanan_bayis', function (Blueprint $table) {
            $table->foreignId('penduduk_id')->constrained('penduduks', 'penduduk_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('berat_badan', 5, 3);
            $table->float('tinggi_badan', 5, 3);
            $table->float('lingkar_kepala', 5, 3);
            $table->float('lingkar_lengan', 5, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_bulanan_bayis');
    }
};
