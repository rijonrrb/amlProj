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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('handedBy');
            $table->string('h_desigation');
            $table->string('h_dept');
            $table->string('h_unit');
            $table->bigInteger('t_id');
            $table->string('takenBy');
            $table->string('t_desigation');
            $table->string('t_dept');
            $table->string('t_unit');
            $table->string('remarks');
            $table->string('qty');
            $table->string('laptop_name');
            $table->string('configuration');
            $table->string('asset_no');
            $table->string('serial_no');
            $table->string('business_area');

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
        Schema::dropIfExists('invoices');
    }
};
