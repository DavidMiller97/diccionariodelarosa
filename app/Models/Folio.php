<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;

    //Se define el nombre de la tabla que debe de ser el mismo al de la base de datos al que hace referencia
    protected $table = 'folio';
    //Se define el nombre de la llave primaria que debe de ser igual al de la tabla al que hace referencia
    protected $primaryKey = 'folio_id';

    /*
        Funcion que trae los textos relacionados con un determinado folio
    */ 
    public function textos(){

        return $this->hasMany(Texto::class, 'folio_id', 'folio_id');
        
    }
}
