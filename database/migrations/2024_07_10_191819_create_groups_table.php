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
        // migration pour la table 'groups'
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->integer('capacity');
            $table->integer('available_space');
          
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
