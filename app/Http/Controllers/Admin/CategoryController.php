<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct() {

    }

    public function index() {
        return view('admin.categories.list');
    }

    public function addCategory() {
        return view('admin.categories.add');
    }

    public function handleAddCategory() {
        return 'Insert Thành Công';
    }

    public function showCategory($id) {
        return view('admin.categories.show', ['id' => $id]);
    }

    public function editCategory($id) {
        return view('admin.categories.edit', ['idCategory' => $id]);
    }

    public function handleUpdateCategory() {
        return 'Cập nhật Thành Công';
    }

    public function deleteCategory() {
        return 'Xoá Thành Công';
    }
}
