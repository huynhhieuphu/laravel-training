<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentHistory extends Model
{
    use HasFactory;

    protected $table = 'eloquent_histories';

    protected $primaryKey = 'history_id';
}
