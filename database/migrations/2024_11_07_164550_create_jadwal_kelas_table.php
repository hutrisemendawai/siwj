<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jadwal_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mata_kuliah');
            $table->text('deskripsi')->nullable();
            $table->string('dosen_pengajar_1');
            $table->string('dosen_pengajar_2')->nullable();
            $table->integer('jumlah_sks');
            $table->string('ruangan');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('hari'); // E.g., 'Senin', 'Selasa', etc.
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kelas');
    }
};
