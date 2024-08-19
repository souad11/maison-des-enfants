<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityGroupTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('activity_group', function (Blueprint $table) {
            $table->id(); // Utilise une colonne 'unsignedBigInteger' pour les clés primaires
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('activity_id');
            

            // Définition des clés étrangères
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('activity_group');
    }
}
