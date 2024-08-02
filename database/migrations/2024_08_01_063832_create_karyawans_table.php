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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->unsignedBigInteger('pekerjaan_id');
            $table->string('divisi', 30);
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();

            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
