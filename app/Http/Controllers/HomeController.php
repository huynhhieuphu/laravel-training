<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public $data = [];

    public function demo() {
        $this->data['title'] = 'Demo blade template';
        $this->data['content'] = '<table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Iphone 14</td>
                <td>19000000</td>
            </tr>
        </tbody>
    </table>';

        $this->data['categories'] = [
            ['id' => 1, 'name' => 'tin tuc'],
            ['id' => 2, 'name' => 'san pham'],
            ['id' => 3, 'name' => 'khuyen mai'],
        ];

        $this->data['products'] = [];

        return view('home', $this->data);
    }

    public function news()
    {
        $this->data['message'] = 'Xoá 1 record thành công';
        $this->data['state'] = 'danger';
        $this->data['title'] = 'Delete';
        return view('client.news', $this->data);
    }

    public function about()
    {
        return view('client.about');
    }
}
