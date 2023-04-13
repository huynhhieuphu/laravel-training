<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $data = [];

    private $userModel;
    private $groupModel;

    public function __construct() {
        $this->userModel = new Users();
        $this->groupModel = new Group();
    }

    public function index(Request $request) {
        $filter = [];
        $keyword = null;

        if(!empty($request->query('group'))) {
            $filter[] = ['user_group_id', '=' , $request->query('group')];
        }

        if(!empty($request->query('status'))) {
            $status = $request->query('status') == 'a' ? 1 : 0;
            $filter[] = ['user_status', '=' , $status];
        }

        if(!empty($request->query('keyword'))){
            $keyword = $request->query('keyword');
        }

        $this->data['direction'] = 'asc';
        $direction = $request->query('direction');
        $direction = trim($direction);
        $column = $request->query('column');
        $sortBy['column'] = trim($column);
        $allowSortBy = ['asc', 'desc'];

        if(!empty($direction) && in_array($direction, $allowSortBy)) {
            if($direction == 'asc') {
                $this->data['direction'] = 'desc';
            }
            $sortBy['direction'] = $direction;
        }

        $this->data['title'] = 'List Users';
        $this->data['users'] = $this->userModel->getAll($filter, $keyword, $sortBy);
        $this->data['listGroups'] = $this->groupModel->getAll();
//        dd($this->data);
        return view('users.index', $this->data);
    }
}
