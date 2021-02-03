<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_procedures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
            $table->foreignId('drug_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('in_procedures');
    }
}
