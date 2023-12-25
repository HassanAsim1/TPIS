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
        Schema::create('linklotcard', function (Blueprint $table) {
            $table->id();
            $table->string('card_id');
            $table->string('user_id');
            $table->string('lot_id');
            $table->string('description');
            $table->string('rate');
            $table->string('total');
            $table->string('verify_lot');
            $table->string('role');
            $table->string('check_by')->nullable();
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
        Schema::dropIfExists('linklotcard');
    }
};
