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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('child_id'); // Clé étrangère pour référencer l'enfant
            $table->unsignedBigInteger('activity_group_id'); // Clé étrangère pour référencer l'association entre groupe et activité
            $table->string('status', 20)->default('pending'); // Statut de l'inscription, ex : pending, confirmed, cancelled
            $table->timestamps(); // Timestamps pour suivre la création et la mise à jour

            // Relations
            $table->foreign('child_id')->references('id')->on('children')
                  ->onDelete('cascade'); // Assure que l'inscription est supprimée si l'enfant est supprimé
            $table->foreign('activity_group_id')->references('id')->on('activity_groups')
                  ->onDelete('cascade'); // Assure que l'inscription est supprimée si l'activité du groupe est supprimée

            // Index pour optimiser les recherches sur ces colonnes
            $table->index(['child_id', 'activity_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
