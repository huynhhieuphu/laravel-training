<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentTag extends Model
{
    use HasFactory;

    protected $table = 'eloquent_tag';

    protected $fillable = [
        'tag_name'
    ];

    public $timestamps = false;

    public function posts() {
        return $this->morphedByMany(EloquentPost::class, 'taggable');
    }

    public function videos() {
        return $this->morphedByMany(EloquentVideo::class, 'taggable');
    }
}
