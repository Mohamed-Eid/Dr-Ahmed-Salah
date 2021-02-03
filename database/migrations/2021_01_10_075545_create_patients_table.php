<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable()->default('default/patient.png');
            $table->date('dob');
            $table->boolean('gender');
            $table->boolean('marital_status');
            $table->string('job_title');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email');
            $table->string('country');
            $table->string('address')->nullable();
            $table->text('how_hear_about_us')->nullable();
            $table->text('chronic_diseases')->nullable();

            $table->boolean('drug_status')->default(0);
            $table->text('drug_text')->nullable();
            
            $table->boolean('smoking_status')->default(0);
            $table->text('smoking_text')->nullable();
            
            $table->boolean('blood_transfusion_status')->default(0);
            $table->text('blood_transfusion_text')->nullable();
            
            $table->boolean('alcoholic_status')->default(0);
            $table->text('alcoholic_text')->nullable();
            
            $table->boolean('previous_sergeries_status')->default(0);
            $table->text('previous_sergeries_text')->nullable();
            
            $table->boolean('family_history_status')->default(0);
            $table->text('family_history_text')->nullable();
            
            $table->text('medications_text')->nullable();
            $table->text('patient_history_text')->nullable();

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
        Schema::dropIfExists('patients');
    }
}
