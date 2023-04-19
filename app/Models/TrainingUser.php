<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingUser extends Model
{
    use HasFactory;

    protected $table = 'training_users';

    protected $primaryKey = 'user_id';

    public function avatar() {

//        return $this->hasOne('App\Models\Avatar');

//        return $this->hasOne(TrainingAvatar::class);

        return $this->hasOne(TrainingAvatar::class, 'avatar_user_id', 'user_id');
    }

    public function posts() {
        return $this->hasMany(TrainingPost::class, 'post_user_id', 'user_id');
    }

    public function latestPost() {
        return $this->hasOne(TrainingPost::class, 'post_user_id', 'user_id')
            ->latest();
    }

    public function post() {
        return $this->hasOne(TrainingPost::class, 'post_user_id', 'user_id')
            ->orderByDesc('post_created_at');
    }

}
