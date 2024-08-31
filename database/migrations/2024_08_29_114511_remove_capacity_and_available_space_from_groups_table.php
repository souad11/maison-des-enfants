<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn(['capacity', 'available_space']);
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->integer('capacity')->unsigned()->nullable();
            $table->integer('available_space')->unsigned()->nullable();
        });
    }
};
