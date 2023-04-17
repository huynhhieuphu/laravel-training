<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /*protected $table = 'my_posts';

    protected $primaryKey = 'post_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $dateFormat = 'd-m-Y';

    const CREATED_AT = 'post_created_at';
    const UPDATED_AT = 'post_updated_at';

    protected $connection = 'connection-name';

    protected $attributes = [
        'status' => 1
    ];*/
    protected $primaryKey = 'post_id';

    public $timestamps = false;
}
