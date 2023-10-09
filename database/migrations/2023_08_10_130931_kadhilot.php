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
        Schema::create('kadhilots', function (Blueprint $table) {
            $table->id();
            $table->string('lot_id');
            $table->string('lot_quantity');
            $table->string('front_image');
            $table->string('back_image');
            $table->string('front_stich')->nullable();
            $table->string('back_stich')->nullable();
            $table->string('total_stich')->nullable();
            $table->string('stich_rate')->nullable();
            $table->string('total_amount')->nullable();
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
        Schema::dropIfExists('kadhilots');
    }
};
