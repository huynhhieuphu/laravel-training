<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingAvatar extends Model
{
    use HasFactory;

    protected $table = 'training_avatars';

    protected $primaryKey = 'avatar_id';

    public function user() {
        return $this->belongsTo(TrainingUser::class, 'avatar_user_id', 'user_id');
    }
}
