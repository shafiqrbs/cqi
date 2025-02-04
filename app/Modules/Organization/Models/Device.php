<?php

namespace App\Modules\Organization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App;


class Device extends Model
{
    use HasFactory;
    protected $table = 'sur_device';
    protected $fillable = [
        'name',
        'canteen_id',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }

    public function canteen(){
        return $this->hasOne(Canteen::class, 'id', 'canteen_id');
    }
}
