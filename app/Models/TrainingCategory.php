<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    use HasFactory;

    protected $table = 'training_categories';

    protected $primaryKey = 'category_id';

    const CREATED_AT = 'category_created_at';

    public function posts() {
        return $this->belongsToMany(TrainingPost::class, 'training_categories_posts', 'category_id', 'post_id')
            ->as('detail');
    }
}
