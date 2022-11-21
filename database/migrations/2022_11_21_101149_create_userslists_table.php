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
        Schema::create('userslists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('desigation');
            $table->string('dept');
            $table->string('wstation'); 	
            $table->string('unit');
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->string('asset_no')->nullable();
            $table->unsignedBigInteger('ip_id')->nullable();
            $table->string('ip')->nullable();
            $table->unsignedBigInteger('vpn_id')->nullable();
            $table->string('vpn')->nullable();

            $table->foreign('asset_id')->references('id')->on('itcuses');
            $table->foreign('ip_id')->references('id')->on('ips');
            $table->foreign('vpn_id')->references('id')->on('vpns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userslists');
    }
};
