<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_jadwal_kegiatans_table.php
public function up()
{
    Schema::create('jadwal_kegiatans', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->date('date');
        $table->string('tahun_ajaran'); // Tambahkan kolom tahun ajaran
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kegiatans');
    }
};
