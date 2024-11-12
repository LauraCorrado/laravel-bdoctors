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
        // elimino la tabella ratings e la pivot doctor_rating per inserire una colonna rating all'interno di reviews
        Schema::dropIfExists('doctor_rating');
        Schema::dropIfExists('ratings');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
