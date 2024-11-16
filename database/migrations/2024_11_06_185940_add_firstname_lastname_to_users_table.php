<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->after('id');
            $table->string('lastname')->after('firstname');
            $table->dropColumn('name'); // Remove if the original 'name' field exists
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname']);
            $table->string('name')->after('id'); // Restore original 'name' column if needed
        });
    }
    
};
