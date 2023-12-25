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
        Schema::create('linkshirtlots', function (Blueprint $table) {
            $table->id();
            $table->text('lot_id');
            $table->string('lot_color');
            $table->string('lot_quantity');
            $table->string('lot_size');
            // $table->foreign('lot_id');
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
        Schema::dropIfExists('linkshirtlots');
    }
};
