<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct() {
        //Xử lý middleware trong phương thức __construct

        // Phương thức expect() dùng loại bỏ các method không cần dùng middleware
        //$this->middleware('check.permission')->except('index');

        // Phương thức only() dùng ap dụng các method cần dùng tới middleware
        $this->middleware('check.permission')->only(['editCategory', 'addCategory']);
    }

    // Hiển thị danh sách danh mục
    // request method: GET
    public function index() {
        return view('admin.categories.list');
    }

    // Hiển thị form thêm danh mục
    // request method: GET
    public function addCategory() {
        return view('admin.categories.add');
    }

    // Thêm mới 1 danh mục
    //request method: POST
    public function handleAddCategory() {
        return 'Insert Thành Công';
    }

    // Hiển thị chi tiết 1 danh mục
    //request method: GET
    public function showCategory($id) {
        return view('admin.categories.show', ['id' => $id]);
    }

    // Hiển thị chi tiết 1 danh mục
    //request method: GET
    public function editCategory($id) {
        return view('admin.categories.edit', ['idCategory' => $id]);
    }

    // Cập nhật 1 danh mục
    //request method: POST|PUT|PATCH
    public function handleUpdateCategory() {
        return 'Cập nhật Thành Công';
    }

    // Xoá 1 danh mục
    //request method: POST|DELETE
    public function deleteCategory() {
        return 'Xoá Thành Công';
    }
}
