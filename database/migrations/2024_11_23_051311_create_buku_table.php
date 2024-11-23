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
        Schema::create('buku', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('member_id')->nullable(); // Relasi ke members
            // Foreign Key Constraint
            $table->foreign('member_id')->references('id')->on('member');
            $table->string('judul_buku');
            $table->string('autor_buku');
            $table->date('tanggal_terbit_buku');
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
