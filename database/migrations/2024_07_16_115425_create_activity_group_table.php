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
        Schema::create('activity_group', function (Blueprint $table) {
            $table->id(); // ID unique pour chaque entrée
            $table->unsignedBigInteger('activity_id'); // Clé étrangère pour référencer une activité
            $table->unsignedBigInteger('group_id'); // Clé étrangère pour référencer un groupe

            // Définir les contraintes de clé étrangère pour s'assurer que les références à 'activities' et 'groups' sont maintenues
            $table->foreign('activity_id')->references('id')->on('activities')
                  ->onDelete('cascade'); // Supprime la relation si l'activité est supprimée
            $table->foreign('group_id')->references('id')->on('groups')
                  ->onDelete('cascade'); // Supprime la relation si le groupe est supprimé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_group');
    }
};
