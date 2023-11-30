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
        Schema::create('table_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria', 50)->nullable();
            $table->integer('bobot_kriteria')->nullable();
            $table->string('jenis_kriteria', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_kriteria');
    }
};
