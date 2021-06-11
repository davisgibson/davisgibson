<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('owner');
            $table->integer('bidId');
            $table->string('type');
            $table->string('footage');
            $table->string('address');
            $table->string('infoFolder');
            $table->float('listPrice')->nullable();
            $table->float('cashPrice')->nullable();
            $table->boolean('ForSale')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
