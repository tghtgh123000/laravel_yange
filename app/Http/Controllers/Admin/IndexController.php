<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function indexAction(){
        return view('admin.index.index');
    }
}
