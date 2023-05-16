<?php

use App\Models\Autor;
use App\Models\Texto;
use App\Http\Resources\AutorResource;
use App\Http\Resources\LibroResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FolioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CreditoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
/*Folio*/
Route::get('/diccionario', [FolioController::class, 'index'])->name('folio.index');
Route::get('/folio', [FolioController::class, 'texto'])->name('folio.texto');
Route::get('/folio/imagen/{filename}', [FolioController::class, 'getFolio'])->name('folio.imagen');
/*Creditos*/
Route::get('/creditos', [CreditoController::class, 'index'])->name('credito.index'); 
/*Autor*/
Route::get('/libro/{texto_id}', function ($texto_id) {
    
    $textos = Texto::all();

    $texto = $textos->find($texto_id);

    $libros = $texto->libros;

    if(count($libros) > 0) {
        return LibroResource::collection($libros);
    }

    abort(404);

});
/*Buscador*/
Route::post('/buscar', [LibroController::class, 'buscar'])->name('buscar');