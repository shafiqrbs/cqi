<?php

namespace App\Modules\Swapno\Models;

use app;
use DB;
use Illuminate\Database\Eloquent\Model;


class Sales extends Model
{
    protected $table = 'swapno_sales';
    protected $fillable = [
        'organization_id',
        'category_id',
        'month',
        'year',
        'total_sales_amount',
        'total_sales_quantity',
        'report_date',
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

    public static function categoryDropdown(){
        $category = Sales::where('is_active','1')->pluck('name','id')->all();
        $category = $category+['Choose Category'];
        $first = [0 => $category[0]];
        unset($category[0]);
        $category = $first + $category;
        return $category;
    }
}
