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
        Schema::create('table_decision_matrix', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kriteria');
            $table->foreign('id_kriteria')->references('id')->on('kriteria')->onDelete('cascade');
            $table->unsignedBigInteger('id_alternatif');
            $table->foreign('id_alternatif')->references('id')->on('alternatif')->onDelete('cascade');
            $table->decimal('value', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_decision_matrix');
    }
};
