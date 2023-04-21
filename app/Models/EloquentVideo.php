<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentVideo extends Model
{
    use HasFactory;

    protected $table = 'eloquent_videos';

    protected $primaryKey = 'video_id';

    // polymorphic relationships
    // one to many
    public function comments() {
        return $this->morphMany(EloquentComment::class, 'commentable');
    }

    public function comment() {
        return $this->morphone(EloquentComment::class, 'commentable')->latest();
    }

    // many to many
    public function tags() {
        return $this->morphToMany(EloquentTag::class, 'taggable');
    }

}
