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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('registration_id'); 
            $table->decimal('amount', 10, 2); // Montant du paiement
            $table->string('status', 20)->default('pending'); // Statut du paiement, ex : pending, completed, refunded
            $table->timestamps(); // Timestamps pour suivre la création et la mise à jour

            // Définir la contrainte de clé étrangère
            $table->foreign('registration_id')->references('id')->on('registrations')
                  ->onDelete('cascade'); // Assure que le paiement est supprimé si l'inscription est supprimée

            // Index pour optimiser les recherches sur ces colonnes
            $table->index(['registration_id', 'stripe_payment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
