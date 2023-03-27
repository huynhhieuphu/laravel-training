<?php
namespace App\Http\View\Composer;

use Illuminate\View\View;

class ProfileComposer
{
    public function compose(View $view) {
        $view->with('name', 'Huỳnh Hiếu Phú');
    }
}
