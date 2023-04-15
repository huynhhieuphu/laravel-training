<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    const _PER_PAGE = 5;
    const _PREFIX_USERS = 'user_';
    public $data = [];

    private $userModel;
    private $groupModel;

    public function __construct()
    {
        $this->userModel = new Users();
        $this->groupModel = new Group();
        $this->data['listGroup'] = $this->groupModel->getAll();
    }

    public function index(Request $request)
    {
        $this->data['o'] = 'asc';
        $this->data['title'] = 'List Users';
        $this->data['users'] = $this->userModel->getAll($this->filter($request->query()),
            $this->search($request->query()), $this->sort($request->query(), self::_PREFIX_USERS), self::_PER_PAGE);

//        dd($this->data);
        return view('users.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Create User';
        $this->data['msg'] = 'Vui lòng kiểm tra dữ liệu';
        $this->data['selected'] = true;
        return view('users.create', $this->data);
    }

    public function add(UserRequest $request)
    {
        $data = [
            'user_firstname' => $request->input('user_firstname'),
            'user_lastname' => $request->input('user_lastname'),
            'user_email' => $request->input('user_email'),
            'user_group_id' => $request->input('user_group_id'),
            'user_status' => $request->input('user_status'),
            'user_created_at' => date('Y-m-d H:i:s', time())
        ];

        $user = $this->userModel->insertRecord($data);

        if ($user) {
            return redirect()
                ->route('dashboard.users.index')
                ->with('msg_success', 'Inserted Successfully');
        }
        return back()->withInput()->with('msg', 'Insert Failed');
    }

    public function edit($userId = 0)
    {
        if ($userId > 0) {
            $user = $this->userModel->detailRecord($userId);
            if (!empty($user)) {
                session(['ss_user_id' => $user->user_id]);
                $this->data['title'] = 'Edit User: ' . $user->user_firstname;
                $this->data['user'] = $user;
                return view('users.edit', $this->data);
            }
        }
        return redirect()->route('dashboard.users.index')->with('msg', 'Not Found');
    }

    public function update(UserRequest $request)
    {
        $userId = session('ss_user_id');
        session()->forget('ss_user_id');

        if ($userId > 0) {
            $user = $this->userModel->detailRecord($userId);
            if (!empty($user)) {
                $data = [
                    'user_firstname' => $request->input('user_firstname'),
                    'user_lastname' => $request->input('user_lastname'),
                    'user_email' => $request->input('user_email'),
                    'user_group_id' => $request->input('user_group_id'),
                    'user_status' => $request->input('user_status'),
                    'user_updated_at' => date('Y-m-d H:i:s', time())
                ];

                $updated = $this->userModel->updateRecord($user->user_id, $data);
                if ($updated) {
                    return redirect()
                        ->route('dashboard.users.index')
                        ->with('msg_success', 'Updated Successfully');
                }
                return back()->withInput()->with('msg', 'Update Failed');
            }
        }
        return redirect()->route('dashboard.users.index')->with('msg', 'Not Found');
    }

    public function trash(Request $request)
    {
        $this->data['o'] = 'asc';
        $this->data['title'] = 'List Trash';
        $this->data['users'] = $this->userModel->getAll($this->filter($request->query()),
            $this->search($request->query()), $this->sort($request->query(), self::_PREFIX_USERS), self::_PER_PAGE,
            true);

        return view('users.trash', $this->data);
    }

    public function remove(Request $request)
    {
        $userId = $request->input('user_id');
        if ($userId > 0) {
            $user = $this->userModel->detailRecord($userId);
            if (!empty($user)) {
                $data = [
                    'user_trash' => 1,
                    'user_updated_at' => date('Y-m-d H:i:s', time())
                ];
                $updated = $this->userModel->updateRecord($user->user_id, $data);
                if ($updated) {
                    return redirect()
                        ->route('dashboard.users.index')
                        ->with('msg_success', 'Removed Successfully');
                }
                return back()->withInput()->with('msg', 'Remove Failed');
            }
        }
        return redirect()->route('dashboard.users.index')->with('msg', 'Not Found');
    }

    public function delete(Request $request)
    {
        $userId = $request->input('user_id');
        if ($userId > 0) {
            $deleted = $this->userModel->deleteRecord($userId);
            if ($deleted) {
                return redirect()
                    ->route('dashboard.users.trash')
                    ->with('msg_success', 'Deleted Successfully');
            }
            return back()->withInput()->with('msg', 'Deleted Failed');
        }
        return redirect()->route('dashboard.users.trash')->with('msg', 'Not Found');
    }

    public function rollback(Request $request)
    {
        $userId = $request->input('user_id');
        if ($userId > 0) {
            $user = $this->userModel->detailRecord($userId);
            if (!empty($user)) {
                $data = [
                    'user_trash' => 0,
                    'user_updated_at' => date('Y-m-d H:i:s', time())
                ];
                $updated = $this->userModel->updateRecord($user->user_id, $data);
                if ($updated) {
                    return redirect()
                        ->route('dashboard.users.index')
                        ->with('msg_success', 'Rollback Successfully');
                }
                return back()->withInput()->with('msg', 'Rollback Failed');
            }
        }
        return redirect()->route('dashboard.users.index')->with('msg', 'Not Found');
    }

    private function filter($query)
    {
        $result = [];

        if (!empty($query['group'])) {
            $result[] = ['user_group_id', '=', $query['group']];
        }

        if (!empty($query['status'])) {
            $status = $query['status'] == 'active' ? 1 : 0;
            $result[] = ['user_status', '=', $status];
        }
        return $result;
    }

    private function search($query)
    {
        if (!empty($query['keyword'])) {
            return $query['keyword'];
        }

        return null;
    }

    private function sort($query, $prefix)
    {
        $result = [];
        $order = null;
        $allowSortBy = ['asc', 'desc'];

        if (!empty($query['s'])) {
            $result['s'] = $prefix . trim($query['s']);
        }

        if (!empty($query['o'])) {
            $order = trim($query['o']);
        }

        if (in_array($order, $allowSortBy)) {
            if ($order == 'asc') {
                $this->data['o'] = 'desc';
            }
            $result['o'] = $order;
        }

        return $result;
    }
}
