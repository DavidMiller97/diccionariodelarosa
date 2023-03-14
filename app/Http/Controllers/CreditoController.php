<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditoController extends Controller
{
    /*
        Funcion que muestra la vista principal del modulo de credito
    */ 
    public function index(){

        return view('credito.index');
    }
}
