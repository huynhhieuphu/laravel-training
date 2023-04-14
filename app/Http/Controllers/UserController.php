<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const _PER_PAGE = 5;
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
            $status = $request->query('status') == 'active' ? 1 : 0;
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
        $this->data['users'] = $this->userModel->getAll($filter, $keyword, $sortBy, self::_PER_PAGE);
        $this->data['listGroup'] = $this->groupModel->getAll();
//        dd($this->data);
        return view('users.index', $this->data);
    }

    public function create() {
        $this->data['title'] = 'Create User';
        $this->data['listGroup'] = $this->groupModel->getAll();
        $this->data['msg'] = 'Vui lòng kiểm tra dữ liệu';
        return view('users.create', $this->data);
    }

    public function add(Request $request) {
//        dd($request->all());
        $request->validate([
            'user_firstname' => 'required|string|max:100',
            'user_lastname' => 'nullable|string|max:100',
            'user_email' => 'required|email|unique:users,user_email',
            'user_group_id' => ['required', function($attribute, $value, $fail){
                if($value <= 0){
                    $fail('Invalid data');
                }
            }],
            'user_status' => 'required|in:0,1',
        ]);

        $data = [
            'user_firstname' => $request->input('user_firstname'),
            'user_lastname' => $request->input('user_lastname'),
            'user_email' => $request->input('user_email'),
            'user_group_id' => $request->input('user_group_id'),
            'user_status' => $request->input('user_status'),
            'user_created_at' => date('Y-m-d H:i:s', time())
        ];

        $user = $this->userModel->insertRecord($data);
        if($user) {
            return redirect()
                ->route('dashboard.users.index')
                ->with('insert_success', 'Inserted Successfully');
        }
        return back()->withInput()->with('msg', 'Error System');
    }
}
