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
        Schema::create('link_fabric_lots', function (Blueprint $table) {
            $table->id();
            $table->string('fabricId');
            $table->string('rollId');
            $table->string('rollSubId');
            $table->string('roleQuantity');
            $table->string('rollUseStatus');
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
        Schema::dropIfExists('link_fabric_lots');
    }
};
