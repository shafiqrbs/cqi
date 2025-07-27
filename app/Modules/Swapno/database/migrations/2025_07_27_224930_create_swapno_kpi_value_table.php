<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapnoKpiValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swapno__kpi_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kpi_id')->index('kpi_id');
            $table->unsignedBigInteger('particular_id')->index('particular_id');
            $table->string('kpi_value')->nullable();
            $table->boolean('is_feature')->default(0);
            $table->timestamps();
            $table->foreign('kpi_id')->references('id')->on('swapno__kpi')->onDelete('cascade');
            $table->foreign('particular_id')->references('id')->on('swapno__particulars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swapno_kpi_value');
    }
}
