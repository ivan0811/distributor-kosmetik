<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MainController extends Controller
{            
   function dashboard(){
       return view('dashboard');
   }
}
