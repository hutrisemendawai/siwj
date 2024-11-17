<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom `name`
            $table->string('name')->after('id');

            // Hapus kolom `firstname` dan `lastname`
            $table->dropColumn(['firstname', 'lastname']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke `firstname` dan `lastname` jika rollback
            $table->string('firstname')->after('id');
            $table->string('lastname')->after('firstname');

            // Hapus kolom `name`
            $table->dropColumn('name');
        });
    }
};
