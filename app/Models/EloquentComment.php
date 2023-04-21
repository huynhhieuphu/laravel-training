<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentComment extends Model
{
    use HasFactory;

    protected $table = 'eloquent_comments';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'comment_content'
    ];

    public $timestamps = false;

    const CREATED_AT = 'comment_created_at';
    const UPDATED_AT = 'comment_updated_at';

    public function commentable() {
        return $this->morphTo();
    }
}
