<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FolioController extends Controller
{
    /*
        Funcion que muestra la vista principal del modulo de folio
    */ 
    public function index(){

        return view('folio.index');
    }

    /*
        Funcion que muestra la vista donde se muestran los folios, esta utiliza la paginacion para mostrar un folio por pagina
    */ 
    public function texto(){

        //Paginacion
        $folios = Folio::paginate(1);
        $foliosLetras = ['A' => '15', 'B' => '47', 'C' => '65', 'D' => '93', 'E' => '107', 'F' => '123', 'G' => '135', 'H' => '149', 'I' => '161', 'J' => '169', 'K' => '179', 'L' => '185', 'M' => '205', 'N' => '237', 'O' => '251', 'P' => '267', 'Q' => '299', 'R' => '311', 'S' => '331', 'T' => '361', 'V' => '383', 'X' => '413', 'Y' => '419', 'Z' => '427'];

        //Se envia el folio a la vista
        return view('folio.folio', ['folios' => $folios, 'foliosLetras' => $foliosLetras]);
    }

    /*
        Funcion para obtener las imagen del folio
    */ 
    public function getFolio($filename){

        //Se busca la imagen en la carpeta folios de la carpeta storage
        $file = Storage::disk('folios')->get($filename);

        return new Response($file, 200);
    }
}
