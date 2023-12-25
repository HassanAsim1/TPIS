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
        Schema::create('change_working_areas', function (Blueprint $table) {
            $table->id();
            $table->string('employeeId');
            $table->string('currentWorkingArea');
            $table->string('changeWorkingArea');
            $table->string('changeBy');
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
        Schema::dropIfExists('change_working_areas');
    }
};
