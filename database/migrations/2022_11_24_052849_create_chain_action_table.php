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
        Schema::create('chain_action', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('installation_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('install_chain');
            $table->timestamps();

            $table->foreign('installation_id')->references('id')->on('installation');
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chain_action');
    }
};
