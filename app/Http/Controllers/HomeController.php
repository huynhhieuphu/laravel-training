<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index() {
        // truyền data vào view, có 3 cách:
        $title = 'Laravel Training';
        $content = 'View Laravel';

        // Cách 1: truyền data vào view 1 mảng
//        $data = ['title' => $title, 'content' => $content];
//        return view('home', $data);

        // Cách 2: Truyền data vào view bằng 1 hàm compact('varNameA', 'varNameB')
        // các key tương ứng tên biến
//        return view('home', compact('title', 'content'));

        // Cách 3: Truyền data vào view bằng phương thức with()
//        $data = ['title' => $title, 'content' => $content];
//        return view('home')->with($data);

        // Thông thường sử dụng cách 1 hoặc 2 là nhiều.

        // Load view dạng class view
        return View::make('home', compact('title', 'content'));
    }

    public function exportPDF() {
        // render HTML dạng khô
        dd(view('report')->render());
    }
}
