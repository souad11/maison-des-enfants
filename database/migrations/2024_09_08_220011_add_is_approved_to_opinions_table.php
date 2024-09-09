<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsApprovedToOpinionsTable extends Migration
{
    public function up()
    {
        Schema::table('opinions', function (Blueprint $table) {
            $table->boolean('is_approved')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('opinions', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
}
