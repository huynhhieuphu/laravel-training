<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentImage extends Model
{
    use HasFactory;

    protected $table = 'eloquent_images';

    protected $primaryKey = 'image_id';

    protected $fillable = ['image_name', 'image_url', 'imageable_id', 'imageable_type'];

    public $timestamps = false;

    public function imageable() {
        return $this->morphTo();
    }
}
