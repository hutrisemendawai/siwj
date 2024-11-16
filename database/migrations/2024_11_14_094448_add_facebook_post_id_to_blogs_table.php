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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('facebook_post_id')->nullable()->after('image')->unique();
        });
    }
    
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('facebook_post_id');
        });
    }
    
};
