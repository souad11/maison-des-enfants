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
        Schema::table('activity_group', function (Blueprint $table) {
            $table->foreignId('educator_id')->nullable()->constrained('educators')->onDelete('cascade')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_group', function (Blueprint $table) {
            $table->dropForeign(['educator_id']);
            $table->dropColumn('educator_id');
        });
    }
};
