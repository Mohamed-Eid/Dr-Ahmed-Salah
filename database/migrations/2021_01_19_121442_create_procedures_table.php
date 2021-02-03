<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
            $table->foreignId('surgery_id')->constrained()->onDelete('cascade');
            $table->date('surgery_date');
            $table->date('discharge_date');
            $table->time('operative_time');
            $table->text('operative_details')->nullable();
            $table->text('others')->nullable();
            $table->boolean('complications_status');
            $table->text('complications_text')->nullable();

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
        Schema::dropIfExists('procedures');
    }
}
