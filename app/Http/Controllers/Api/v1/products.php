<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class products extends Controller
{
    public function index() {
        return 'Danh sách sản phẩm call api';
    }
}
