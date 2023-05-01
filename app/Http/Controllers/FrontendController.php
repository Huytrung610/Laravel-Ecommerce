<?php

namespace App\Http\Controllers;


use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class FrontendController extends Controller
{
    public function login()
    {
        return view('frontend.login');
    }
    
   
}


