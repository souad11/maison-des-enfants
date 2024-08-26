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
        Schema::create('partners', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('name', 255); // Nom du partenaire
            $table->text('description')->nullable(); // Description du partenaire
            $table->string('address', 255)->nullable(); // Adresse du partenaire
            $table->string('phone_number', 20)->nullable(); // Numéro de téléphone du partenaire
            $table->string('website', 255)->nullable(); // Site web du partenaire
            $table->string('picture', 255)->nullable(); // Image du partenaire
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
