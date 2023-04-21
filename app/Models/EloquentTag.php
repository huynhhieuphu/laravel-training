<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentTag extends Model
{
    use HasFactory;

    protected $table = 'eloquent_tags';

    protected $primaryKey = 'tag_id';

    protected $fillable = [
        'tag_name'
    ];

    public $timestamps = false;

    public function posts()
    {
        return $this->morphedByMany(
            EloquentPost::class, // class quan hệ
            'taggable', // tên đa hình
            'eloquent_taggables', // tên bảng trung gian đa hình
            'tag_id', // khoá ngoại bảng trung gian
            'taggable_id'); // khoá liên quan bảng trung gian
    }

    public function videos()
    {
        return $this->morphedByMany(
            EloquentVideo::class,
            'taggable',
            'eloquent_taggables',
            'tag_id',
            'taggable_id');
    }
}
