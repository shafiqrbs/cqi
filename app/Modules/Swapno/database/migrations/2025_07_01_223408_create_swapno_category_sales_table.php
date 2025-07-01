<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapnoCategorySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swapno_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('month',20);
            $table->string('year',20);
            $table->float('total_sales_amount', 8, 2)->default(0);
            $table->integer('total_sales_quantity')->default(0);
            $table->date('report_date');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')->on('sur_organization')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('swapno_category')
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
        Schema::dropIfExists('swapno_category_sales');
    }
}
