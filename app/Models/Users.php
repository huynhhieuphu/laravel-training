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

    public function getAll($filter = [], $keyword = null, $sortBy = [], $page = null)
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

        $column = $this->table.'.user_id';
        $direction = 'desc';
        if(!empty($sortBy['column']) && !empty($sortBy['direction'])) {
            $column = $this->table.'.'.$sortBy['column'];
            $direction = $sortBy['direction'];
        }
        $query = $query->orderBy($column, $direction);


        if(!empty($page)) {
            $query = $query->paginate($page)->withQueryString();
        } else {
            $query = $query->get();
        }

//        dd(DB::getQueryLog());
        return $query;
    }
}
