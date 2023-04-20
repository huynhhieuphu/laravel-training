<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentTeam extends Model
{
    use HasFactory;

    protected $table = 'eloquent_teams';

    protected $primaryKey = 'team_id';

    public function users() {
        return $this->hasMany(EloquentUser::class, 'user_team_id', 'team_id');
    }

    public function goals() {
        return $this->hasManyThrough(
            EloquentGoal::class,
            EloquentUser::class,
            'user_team_id', // khóa ngoại ở bảng trung gian users
            'goal_user_id', // khóa ngoại ở bảng đích goals
            'team_id', // khóa chính ở bảng teams
            'user_id', // khóa chính ở bảng users
        );
    }

    public function goal() {
        return $this->hasOneThrough(
            EloquentGoal::class,
            EloquentUser::class,
            'user_team_id', // khóa ngoại ở bảng trung gian users
            'goal_user_id', // khóa ngoại ở bảng đích goals
            'team_id', // khóa chính ở bảng teams
            'user_id', // khóa chính ở bảng users
        )->orderByDesc('goal_number_of_goals');
    }
}
