<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNonSurgeryIdToInProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_procedures', function (Blueprint $table) {
            $table->dropForeign('in_procedures_drug_id_foreign');
            $table->dropColumn('drug_id');

            $table->foreignId('non_surgery_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('in_procedures', function (Blueprint $table) {
        });
    }
}
