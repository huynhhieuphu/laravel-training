<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentPost extends Model
{
    use HasFactory;

    protected $table = 'eloquent_posts';

    protected $primaryKey = 'post_id';

    // polymorphic relationship
    // one to one
    public function image() {
        return $this->morphOne(EloquentImage::class, 'imageable');
    }
}
