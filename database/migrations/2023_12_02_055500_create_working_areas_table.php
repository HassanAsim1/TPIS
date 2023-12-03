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
        Schema::create('working_areas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('workingAreaId');
            $table->string('workingAreaName');
            $table->string('addedBy');
            $table->string('workingAreaStatus');
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
        Schema::dropIfExists('working_areas');
    }
};
