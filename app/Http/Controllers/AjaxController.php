<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //

    public function index(){
          return view('ajax.index'); //resources/views/ajax/index.blade.php
    }

    public function users(){
         return view('users.userpage'); //resources/views/users/userpage.blade.php
         
    }


}
