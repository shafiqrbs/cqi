<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapnoKpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swapno__kpi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable()->index('organization_id');
            $table->string('month')->nullable()->index('month');
            $table->integer('year')->nullable()->index('year');
            $table->boolean('is_active')->default(1);
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('organization_id')
                ->references('id')->on('sur_organization')
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
        Schema::dropIfExists('swapno_kpi');
    }
}
