<?php

namespace App\Modules\Swapno\Models;

use app;
use DB;
use Illuminate\Database\Eloquent\Model;


class Particulars extends Model
{
    protected $table = 'swapno__particulars';
    protected $fillable = [
        'name',
        'slug',
        'particular_id',
        'group',
        'is_featured'
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
        return $this->belongsTo(ParticularTypes::class,'particular_id');
    }
}
