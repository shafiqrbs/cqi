<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapnoTotalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swapno_total', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->integer('nic_training_completed')->default(0);
            $table->integer('nic_member_received_training')->default(0);
            $table->integer('peer_educator_selected')->default(0);
            $table->integer('female_peer_educator')->default(0);
            $table->integer('male_peer_educator')->default(0);
            $table->integer('peer_educator_received_training')->default(0);
            $table->integer('female_participant')->default(0);
            $table->integer('male_participant')->default(0);
            $table->integer('peer_educator_tot_completed')->default(0);
            $table->integer('training_conducted_for_fps_staff')->default(0);
            $table->integer('fps_staff_received_training')->default(0);
            $table->integer('sbcc_materials_developed')->default(0);
            $table->integer('sbcc_items_distributed')->default(0);
            $table->integer('campaign_organized')->default(0);
            $table->integer('workers_purchased_during_campaign')->default(0);
            $table->decimal('bdt_during_campaign',12,2)->default(0);
            $table->integer('female_worker')->default(0);
            $table->integer('male_worker')->default(0);
            $table->integer('workers_purchased_from_fps')->default(0);
            $table->decimal('amount_sales_through_credit',12,2)->default(0);
            $table->decimal('workers_purchased_through_credit',12,2)->default(0);
            $table->decimal('amount_sales_through_cash',12,2)->default(0);
            $table->decimal('total_sales_in_bdt',12,2)->default(0);
            $table->integer('products_available_in_fps')->default(0);
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
        Schema::dropIfExists('swapno_total');
    }
}
