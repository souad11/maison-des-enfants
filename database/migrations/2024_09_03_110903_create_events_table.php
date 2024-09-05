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
        Schema::create('events', function (Blueprint $table) {
            
            $table->id();
            $table->string('title');          // Titre de l'événement
            $table->text('description');      // Description de l'événement
            $table->dateTime('event_date');   // Date et heure de l'événement
            $table->string('photo')->nullable(); // Chemin de la photo de l'événement
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
