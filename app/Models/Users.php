<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAll($filter, $keyword)
    {
//        DB::enableQueryLog();
        $query = DB::table($this->table)
            ->select($this->table.'.*', 'groups.group_name')
            ->join('groups', 'group_id', 'user_group_id');

        if(!empty($filter)) {
            $query = $query->where($filter);
        }

        if(!empty($keyword)) {
            $query =$query->where(function (Builder $builder) use ($keyword) {
                $builder->orWhere('user_firstname', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('user_lastname', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('user_email', 'LIKE', '%'.$keyword.'%');
            });
        }

        $query = $query->orderBy('user_id', 'DESC')->get();
//        dd(DB::getQueryLog());
        return $query;
    }
}
