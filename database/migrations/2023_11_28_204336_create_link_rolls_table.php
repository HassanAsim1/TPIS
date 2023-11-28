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
        Schema::create('link_rolls', function (Blueprint $table) {
            $table->id();
            $table->string('rollId');
            $table->string('rollSubId');
            $table->string('rollDescription');
            $table->string('roleQuantity');
            $table->string('rollRate');
            $table->string('rollTotalrate');
            $table->string('rollUseStatus');
            $table->string('createdBy')->nullable();
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
        Schema::dropIfExists('link_rolls');
    }
};
