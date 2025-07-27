<?php

namespace App\Modules\Swapno\Models;

use app;
use DB;
use Illuminate\Database\Eloquent\Model;


class KpiValue extends Model
{
    protected $table = 'swapno__kpi_value';
    protected $fillable = [
        'kpi_id',
        'particular_id',
        'kpi_value',
        'is_feature',
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

    public function particular_type(){
        return $this->belongsTo('App\Modules\Swapno\Models\Particulars','particular_id');
    }
}
