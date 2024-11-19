<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('sur_device', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('canteen_id')->nullable();
            $table->string('name');
            $table->tinyInteger('status')->nullable()->comment('active = 1, inactive = 0');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('canteen_id')
                ->references('id')->on('sur_canteen')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device');
    }
}
