<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'is_url',
        'post_id',
        'cloudinary_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($imageAsset) {
            if ($imageAsset->cloudinary_id) {
                Cloudinary::destroy($imageAsset->cloudinary_id);
            }
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
