<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Doctor;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('user_name', 150);
            $table->string('user_surname', 150);
            $table->string('city', 150);
            $table->string('address', 150);
            $table->string('phone_number', 20);
            $table->string('cv')->nullable();
            $table->string('thumb')->nullable()->default('https://placehold.co/500x500?text=Avatar');
            $table->text('performance');
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
        Schema::dropIfExists('doctors');
    }
};
