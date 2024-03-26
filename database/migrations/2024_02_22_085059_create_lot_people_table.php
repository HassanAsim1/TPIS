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
        Schema::create('lot_people', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('pantLot');
            $table->unsignedBigInteger('userId');
            $table->string('lotSize');
            $table->string('bandel');
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
        Schema::dropIfExists('lot_people');
    }
};
