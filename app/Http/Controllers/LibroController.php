<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;
use App\Http\Resources\AutorResource;
use App\Http\Resources\LibroResource;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    public function buscar(Request $request){

        //Verificar si se envio un nombre
        if($request->has('nombre')){
            //Se almacena el nombre
            $nombre = $request->string('nombre')->trim();
            //Se verifica si el nombre es nombre del autor o un seudonimo y se recibe el id del autor asociado
            $ids = DB::table('autor')
                ->join('seudonimo', 'autor.autor_id', '=', 'seudonimo.autor_id', 'left outer')
                ->where('autor.nombre', 'like', '%'.$nombre.'%')
                ->orWhere('seudonimo.nombre', 'like', '%'.$nombre.'%')
                ->select('autor.autor_id')
                ->orderBy('autor.autor_id', 'asc')
                ->get();
            //Se traen todos los autores
            $autores = Autor::all();
            //Arreglo para almacenar los autores que tienen el nombre asociado
            $resultados = array();
            //Variable para prevenir los duplicados en el arreglo de autores
            $idActual = 0;
            //Ciclo para recorrer el resultado de la consulta con los autores que tienen el nombre asociado
            foreach($ids as $id){
                //Condicion para evitar los duplicados
                if($idActual != $id->autor_id){

                    $idActual = $id->autor_id;
                    //Se busca el autor por el id, para traer el modelo
                    $autor = $autores->find($idActual);
                    //Si existe el autor lo almaena en el arreglo
                    if(isset($autor)) array_push($resultados, $autor);
                }
                
            }
            //En caso de que el nombre sea del libro, se buscan los libros asociados
            $libros = Libro::where('nombre', 'like', '%'.$nombre.'%')->get();
            //Se trae el resource del autor
            $autorResource = AutorResource::collection($resultados);
            //Se trae el resource del libro
            $libroResource = LibroResource::collection($libros);

            //Se devuelve el json con los resultados 
            return response()->json(['libros' => $libroResource, 'autores' => $autorResource], 200);

        }else{

            return 'Error';
        }

    }
}
