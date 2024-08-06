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
        Schema::create('list_prestasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa');
            $table->foreign('siswa')->references('id')->on('siswa')->onDelete('cascade');
            $table->string('nama_prestasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_prestasi_siswa');
    }
};
