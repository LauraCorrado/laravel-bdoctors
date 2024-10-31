<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors_fields', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('doctor_id');
            // $table->foreign('doctor_id')->references('id')->on('doctors');

            // $table->unsignedBigInteger('field_id');
            // $table->foreign('field_id')->references('id')->on('fields');
            
            $table->foreignId('doctor_id')->constrained();
            $table->foreignId('field_id')->constrained();

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
        Schema::dropIfExists('doctors_fields');
    }
};
