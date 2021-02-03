<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('refferal')->nullable();
            $table->string('email')->nullable();
            $table->string('cellphone1')->nullable();
            $table->string('cellphone2')->nullable();
            $table->string('nationalid')->nullable();
            $table->string('landline')->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->string('Country')->nullable();
            $table->date('BirthDate')->nullable();
            $table->date('favDate')->nullable();
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
        Schema::dropIfExists('site_patients');
    }
}
