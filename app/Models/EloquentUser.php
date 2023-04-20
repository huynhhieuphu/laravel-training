<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    use HasFactory;

    protected $table = 'eloquent_users';

    protected $primaryKey = 'user_id';

    // hasOneThrough
    public function supplier() {
        return $this->belongsTo(EloquentSupplier::class, 'user_supplier_id', 'supplier_id');
    }

    public function history() {
        return $this->hasOne(EloquentHistory::class, 'history_user_id', 'user_id');
    }

    // hasManyThrough
    public function team() {
        return $this->belongsTo(EloquentTeam::class, 'user_team_id', 'team_id');
    }

    public function goals() {
        return $this->hasMany(EloquentGoal::class, 'goal_user_id', 'user_id');
    }

    // polymorphic relationship
    // one to one
    public function image() {
        return $this->morphOne(EloquentImage::class, 'imageable');
    }
}
