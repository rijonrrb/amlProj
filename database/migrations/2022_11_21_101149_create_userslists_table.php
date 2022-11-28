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
            $table->string('userid');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('desigation');
            $table->string('dept');
            $table->string('wstation'); 	
            $table->string('unit');
            $table->string('asset_id')->nullable();
            $table->string('asset_no')->nullable();
            $table->string('ip_id')->nullable();
            $table->string('ip')->nullable();
            $table->string('vpn_id')->nullable();
            $table->string('vpn')->nullable();
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
