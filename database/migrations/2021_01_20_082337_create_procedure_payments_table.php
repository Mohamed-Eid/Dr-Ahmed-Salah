<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedurePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_payments', function (Blueprint $table) {
            $table->id();
            $table->boolean('offer')->nullable()->default(0);

            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('procedure_id')->constrained()->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');

            $table->enum('payment_method', ['cash', 'installments']);	

            $table->integer('procedure_fees');
            
            $table->integer('hospital_cost');
            $table->integer('hospital_other_fees');

            $table->integer('pre_paid_amount');
            //$table->integer('total_remaining_fees');

            $table->integer('doctor_fees');

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
        Schema::dropIfExists('procedure_payments');
    }
}
