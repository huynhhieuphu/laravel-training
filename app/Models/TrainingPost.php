<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPost extends Model
{
    use HasFactory;

    protected $table = 'training_posts';

    protected $primaryKey = 'post_id';

    const CREATED_AT = 'post_created_at';

    // one - many
    public function user() {
        return $this->belongsTo(TrainingUser::class, 'post_user_id', 'user_id');
    }

    // many - many
    public function categories() {
//        return $this->belongsToMany(TrainingCategory::class, 'training_categories_posts', 'post_id', 'category_id');

        return $this->belongsToMany(TrainingCategory::class, 'training_categories_posts', 'post_id', 'category_id')
            ->withPivot('value_tmp');

//        return $this->belongsToMany(TrainingCategory::class, 'training_categories_posts', 'post_id', 'category_id')
//            ->withPivot('value_tmp')->withTimestamps();
    }
}
