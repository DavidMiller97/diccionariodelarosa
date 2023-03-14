<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
        Funcion que muestra la vista principal 
    */ 
    public function index(){

        return view('home');
    }
}
