<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // action index()
    public function index() {
        return 'Home';
    }

    public function getNews() {
        return 'Tin tuc';
    }

    public function getProducts() {
        return 'San pham';
    }

    public function detailProduct($slug) {
        return $slug;
    }
}
