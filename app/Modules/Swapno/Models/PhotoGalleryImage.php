<?php

namespace App\Modules\Swapno\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoGalleryImage extends Model
{

    protected $table = 'photo_gallery_images';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [];


    public function photoGallery(){
        return $this->belongsTo(PhotoGallery::class,'photo_gallery_id','id');
    }
}
