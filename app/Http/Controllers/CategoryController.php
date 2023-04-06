<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index');
    }

    public function add(Request $request) {
        $rules = [
            'category_name' => 'required|min:6',
            'category_order' => 'required|integer'
        ];

        // Custom Message
        $messages = [
            'category_name.required' => 'Vui long nhap truong name',
            'category_name.min' => 'Truong Name it nhat :min ky tu',
            'category_order.required' => 'Vui long nhap truong order',
            'category_order.integer' => 'Truong order khong hop le',
        ];

        $messages = [
            'required' => 'Truong :attribute bat buoc phai nhap',
            'min' => 'Nhap it nhat :min ky tu',
            'integer' => 'Du lieu phai so'
        ];

        $request->validate($rules, $messages);

        $request->validate([
            'category_name' => 'required|min:6',
            'category_order' => 'required|integer'
        ]);

        // next work
        return 'insert data';
    }
}
