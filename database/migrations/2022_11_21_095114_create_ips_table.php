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
        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('name')->nullable();
            $table->string('userid')->nullable();
            $table->string('desigation')->nullable();
            $table->string('dept')->nullable();
            $table->string('wstation')->nullable();
            $table->string('unit')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('issue_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ips');
    }
};
