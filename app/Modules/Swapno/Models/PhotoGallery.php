<?php

namespace App\Modules\Swapno\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoGallery extends Model
{

    protected $table = 'photo_galleries';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [];

    public function photoGalleryImages()
    {
        return $this->hasMany(PhotoGalleryImage::class);
    }
}
