<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsInProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs_in_procedures', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('drug_id')->constrained()->onDelete('cascade');
            $table->foreignId('in_procedure_id')->constrained()->onDelete('cascade');

            $table->integer('amount')->default(1);
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugs_in_procedures');
    }
}
