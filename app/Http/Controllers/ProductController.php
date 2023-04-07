<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $data;

    public function index() {
        $this->data['title'] = 'Add Product';
        $this->data['errorMessage'] = 'Vui Long Kiem Tra Cac Truong';
        return view('products.index', $this->data);
    }

    public function add(ProductRequest $request) {
        dd($request->all());
        //next work
        return 'Insert Data';
    }
}
