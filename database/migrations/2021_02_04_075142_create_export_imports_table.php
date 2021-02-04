<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_imports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('amount');
            $table->text('details');

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
        Schema::dropIfExists('export_imports');
    }
}
