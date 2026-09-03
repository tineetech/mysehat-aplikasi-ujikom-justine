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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->onDelete('cascade');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['pria','wanita']);
            $table->integer('phone')->nullable();
            $table->enum('status', ['active','non-active']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
