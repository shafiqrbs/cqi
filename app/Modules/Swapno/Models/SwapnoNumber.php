<?php

namespace App\Modules\Swapno\Models;

use app;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class SwapnoNumber extends Model
{
    protected $table = 'swapno_total';
    protected $fillable = [
        "organization_id",
        "nic_training_completed",
        "nic_member_received_training",
        "peer_educator_selected",
        "female_peer_educator",
        "male_peer_educator",
        "peer_educator_received_training",
        "female_participant",
        "male_participant",
        "peer_educator_tot_completed",
        "training_conducted_for_fps_staff",
        "fps_staff_received_training",
        "sbcc_materials_developed",
        "sbcc_items_distributed",
        "campaign_organized",
        "workers_purchased_during_campaign",
        "bdt_during_campaign",
        "female_worker",
        "male_worker",
        "workers_purchased_from_fps",
        "amount_sales_through_credit",
        "workers_purchased_through_credit",
        "amount_sales_through_cash",
        "total_sales_in_bdt",
        "products_available_in_fps"
    ];

    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
//                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
//                $query->updated_by = Auth::user()->id;
            }
        });
    }
}
