<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('educator_id');
            $table->string('title');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->integer('capacity');
            $table->integer('available_space');

            $table->foreign('activity_id')->references('id')->on('activities')
                  ->onDelete('cascade');
            $table->foreign('educator_id')->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
