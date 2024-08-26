<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (delete the `langue` column).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('langue');
        });
    }

    /**
     * Reverse the migrations (this will add the `langue` column back).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('langue', 2)->nullable();
        });
    }
};
