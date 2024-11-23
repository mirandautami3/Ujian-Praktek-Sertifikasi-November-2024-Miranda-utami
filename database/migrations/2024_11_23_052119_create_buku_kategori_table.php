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
        Schema::create('buku_kategori', function (Blueprint $table) {
            $table->unsignedBigInteger('buku_id'); // Foreign Key ke buku
            $table->unsignedBigInteger('kategori_id'); // Foreign Key ke kategori
            // Foreign Key Constraints
            $table->foreign('buku_id')->references('id')->on('buku');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_kategori');
    }
};
