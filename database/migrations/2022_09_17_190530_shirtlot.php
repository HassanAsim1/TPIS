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
        Schema::create('shirtlots', function (Blueprint $table) {
            $table->id();
            $table->string('lot_id')->unique();
            $table->string('lot_fabric');
            $table->string('lot_quantity');
            $table->string('lot_remain');
            $table->string('damage_pcs');
            $table->string('cost_price');
            $table->string('sale_price');
            $table->string('lot_master');
            $table->string('lot_size');
            $table->string('status');
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
        Schema::dropIfExists('shirtlots');
    }
};
