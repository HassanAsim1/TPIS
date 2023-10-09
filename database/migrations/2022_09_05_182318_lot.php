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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('lot_id')->unique();
            $table->string('lot_name');
            $table->string('lot_quantity');
            $table->string('lot_remain');
            $table->string('damage_pcs');
            $table->string('cost_price');
            $table->string('sale_price');
            $table->string('lot_master');
            $table->string('lot_size');
            $table->string('rib');
            $table->string('lot_cm');
            $table->string('fcost');
            $table->string('mcost');
            $table->string('beltclip');
            $table->string('fabric_id');
            $table->string('kadi');
            $table->string('outoffactory');
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
        Schema::dropIfExists('lots');
    }
};
