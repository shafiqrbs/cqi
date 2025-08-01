<?php

namespace App\Modules\Swapno\Models;

use app;
use DB;
use Illuminate\Database\Eloquent\Model;


class Kpi extends Model
{
    protected $table = 'swapno__kpi';
    protected $fillable = [
        'organization_id',
        'month',
        'year',
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

    public function kpiValues()
    {
        return $this->hasMany(KpiValue::class)->orderByDesc('id');
    }
}
