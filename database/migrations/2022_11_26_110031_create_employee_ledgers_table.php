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
        Schema::create('employee_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique();
            $table->string('employee_id');
            $table->string('description');
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
            $table->string('given_by')->nullable();
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
        Schema::dropIfExists('employee_ledgers');
    }
};
