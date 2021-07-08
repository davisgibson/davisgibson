<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escrow', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('houseid');
            $table->unsignedBigInteger('seller');
            $table->unsignedBigInteger('buyer');
            $table->unsignedBigInteger('moneyTransfer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escrow');
    }
}
