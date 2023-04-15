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

    public function getAll($filter = [], $keyword = null, $sortBy = [], $page = null, $trash = false)
    {
//        DB::enableQueryLog();

        $query = DB::table($this->table)
            ->select($this->table.'.*', 'groups.group_name')
            ->join('groups', 'group_id', 'user_group_id');

        //trash
        $remove = 0;
        $column = $this->table.'.user_created_at';
        if($trash) {
            $remove = 1;
            $column = $this->table.'.user_updated_at';

        }
        $query = $query->where('user_trash', $remove);
        // filter
        if(!empty($filter)) {
            $query = $query->where($filter);
        }
        // search
        if(!empty($keyword)) {
            $query =$query->where(function (Builder $builder) use ($keyword) {
                $builder->orWhere($this->table.'.user_firstname', 'LIKE', '%'.$keyword.'%')
                    ->orWhere($this->table.'.user_lastname', 'LIKE', '%'.$keyword.'%')
                    ->orWhere($this->table.'.user_email', 'LIKE', '%'.$keyword.'%');
            });
        }
        // sort
        $direction = 'desc';
        if(!empty($sortBy['s']) && !empty($sortBy['o'])) {
            $column = $this->table.'.'.$sortBy['s'];
            $direction = $sortBy['o'];
        }
        $query = $query->orderBy($column, $direction);
        //pagination
        if(!empty($page)) {
            $query = $query->paginate($page)->withQueryString();
        } else {
            $query = $query->get();
        }

//        dd(DB::getQueryLog());
        return $query;
    }

    public function insertRecord($data = []) {
        if(!empty($data)) {
            return DB::table($this->table)->insert($data);
        }
        return false;
    }

    public function detailRecord($id = null) {
        if(!empty($id)) {
            return DB::table($this->table)->where('user_id', $id)->first();
        }
        return false;
    }

    public function updateRecord($id = null, $data = []) {
        if(!empty($id) && !empty($data)) {
            return DB::table($this->table)->where('user_id', $id)->update($data);
        }
        return false;
    }

    public function deleteRecord($id = null) {
        if(!empty($id)) {
            return DB::table($this->table)->where('user_id', $id)->delete();
        }
        return false;
    }
}
