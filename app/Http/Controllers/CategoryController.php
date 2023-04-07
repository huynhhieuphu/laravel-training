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
            'category_name' => ['required','min:6'],
            'category_order' => ['required','integer']
        ];
        // hoặc thành chuỗi ngăn cách bởi dấu gạch |
        $rules = [
            'category_name' => 'required|min:6',
            'category_order' => 'required|integer'
        ];

        // Custom Message
        $messages = [
            'category_name.required' => 'Vui long nhap truong name',
            'category_name.min' => 'Truong Name it nhat 6 ky tu',
            'category_order.required' => 'Vui long nhap truong order',
            'category_order.integer' => 'Truong order khong hop le',
        ];
        // sử dụng :attribute để lấy ra input name
        // sử dụng :min để lấy giá trị
        $messages = [
            'required' => 'Truong :attribute bat buoc phai nhap',
            'min' => 'Nhap it nhat :min ky tu',
            'integer' => 'Du lieu phai so'
        ];

        $request->validate($rules, $messages);

        //hoặc
        $request->validate([
            'category_name' => 'required|min:6',
            'category_order' => 'required|integer'
        ]);

        // next work
        return 'insert data';
    }
}
