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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->string('nama')->unique();
            $table->string('spesialis');
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
        Schema::dropIfExists('dokters');
    }
};
