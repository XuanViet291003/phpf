<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function hello(){
        return response() ->json(['viet' => 'dep trai vo cung']);
    }
}
