<?php

namespace App\Modules\Swapno\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use app;
use DB;


class TotalNumber extends Model
{
    protected $table = 'total_numbers';
    protected $fillable = [
        'factory_onboarded',
        'fps_inaugurated',
        'nic_formed',
        'nic_meeting_conducted',
        'stakeholder_conducted',
        'participants_attend'
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
