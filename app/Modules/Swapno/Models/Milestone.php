<?php

namespace App\Modules\Swapno\Models;

use app;
use DB;
use Illuminate\Database\Eloquent\Model;


class Milestone extends Model
{
    protected $table = 'swapno__milestones';
    protected $fillable = [
        'particular_id',
        'name',
        'slug',
        'is_active',
    ];

    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $date = new \DateTime("now");
            $model->created_at = $date;
        });

        self::updating(function ($model) {
            $date = new \DateTime("now");
            $model->updated_at = $date;
        });
    }

    public function particular(){
        return $this->hasOne(Particulars::class,'id','particular_id');
    }

}
