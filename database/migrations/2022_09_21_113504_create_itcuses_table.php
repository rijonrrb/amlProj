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
        Schema::create('itcuses', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('laptop_name');
            $table->string('asset_no');
            $table->string('serial_no');
            $table->string('previous_user')->nullable();
            $table->string('entry_date');
            $table->string('p_issue_date')->nullable();
            $table->string('configuration')->nullable();
            $table->string('condition');
            $table->string('warrenty_start')->nullable();
            $table->string('warrenty_end')->nullable();
            $table->string('vendor')->nullable();
            $table->string('sid');
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
        Schema::dropIfExists('itcuses');
    }
};
