<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // Lấy tất cả dữ liệu input
//        $allData = $request->all();
//        dd($allData);

//        $username = $allData['username'];
//        dd($username);

        // Lấy dữ liệu của một input
//        $username = $request->input('username');
//        dd($username);

        // Gán giá trị khi input không tồn tại.
//        $remember = $request->input('remember', true);

        // lấy giá trị thuộc tính động
        $username = $request->username;
        dd($username);
    }

    public function showProduct()
    {
        return view('form-product');
    }

    public function storeProduct(Request $request)
    {
//        dd($request->all());

        // Lấy thông tin sản phẩm thứ nhất
//        dd($request->input('product.0'));

        // lấy thông tin tên sản phẩm thứ nhất
//        dd($request->input('product.0.name'));

        // lấy tất cả tên sản phẩm
        dd($request->input('product.*.name'));
    }

    public function login(Request $request)
    {
        // $request->old() get session flash
//        $oldUsername = $request->old('username');
//        return view('form-login', compact('oldUsername'));

        // Dùng method helper old() : get session flash
        return view('form-login');
    }

    public function handleLogin(Request $request)
    {
        // $request->has() tương đương isset()
        if($request->has('username')) {
            echo $request->input('username');
        }

        // Demo Validation
        if(!empty($request->input('password'))) {
            return '<div>Insert Data</div>';
        }
        // $request->flash() set session flash

        //            $request->flash();
//            return redirect()->route('form.login');

        // Cách ngắn gọn hơn
        // hàm back() điều hướng về trang trước
        // hàm withInput() tương tự $request->flash() set session flash
        return back()->withInput();
    }

    public function file()
    {
        return view('form-file');
    }

    public function handleFile(Request $request)
    {
//        $file = $request->file('avatar');

        // $request->hasFile() kiểm tra tồn tại file không ?
        if($request->hasFile('avatar')) {
            $file = $request->avatar;

            // phương thức isValid() kiểm tra file upload thành công không ?
            if($file->isValid()) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
//                dd([
//                    $fileName,
//                    $extension,
//                    $size,
//                    $file->getMaxFilesize()
//                ]);

                // Lưu trong Local: store/app/{path}
//                $file->store('images');

                // Lưu và thay đổi tên file
                $newFilename = md5(uniqid()).'.'.$extension;
                $file->storeAs('images', $newFilename);
            }
        }
    }
}
