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
        Schema::create('lotcard', function (Blueprint $table) {
        $table->id();
        $table->string('card_id')->unique();
        $table->text('user_id');
        $table->string('card_type');
        $table->string('fix_rate');
        $table->string('working_area');
        $table->string('total_pcs');
        $table->string('verify_card');
        $table->string('grand_total');
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
        Schema::dropIfExists('lotcard');
    }
};
