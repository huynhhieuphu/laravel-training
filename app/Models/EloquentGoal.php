<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentGoal extends Model
{
    use HasFactory;

    protected $table = 'eloquent_goals';

    protected $primaryKey = 'goal_id';

    public function user() {
        return $this->belongsTo(EloquentUser::class, 'goal_user_id', 'user_id');
    }
}
