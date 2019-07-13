<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    public function loginAction(){
        if($this->request->isMethod('post')){
            //
        }else{

        }

        return view('admin.public.login');

    }
}
