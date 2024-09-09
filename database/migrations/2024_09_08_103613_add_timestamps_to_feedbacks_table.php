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
    Schema::table('feedbacks', function (Blueprint $table) {
        // Ajouter les colonnes created_at et updated_at
        $table->timestamps();
    });
}

public function down()
{
    Schema::table('feedbacks', function (Blueprint $table) {
        // Supprimer les colonnes created_at et updated_at si on fait un rollback
        $table->dropTimestamps();
    });
}

};
