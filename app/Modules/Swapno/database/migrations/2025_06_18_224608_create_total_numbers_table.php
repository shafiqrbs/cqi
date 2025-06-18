<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('factory_onboarded')->default(0);
            $table->integer('fps_inaugurated')->default(0);
            $table->integer('nic_formed')->default(0);
            $table->integer('nic_meeting_conducted')->default(0);
            $table->integer('stakeholder_conducted')->default(0);
            $table->integer('participants_attend')->default(0);
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
        Schema::dropIfExists('total_numbers');
    }
}
