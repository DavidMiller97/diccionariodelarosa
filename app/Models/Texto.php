<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    use HasFactory;

    //Se define el nombre de la tabla que debe de ser el mismo al de la base de datos al que hace referencia
    protected $table = 'texto';
     //Se define el nombre de la llave primaria que debe de ser igual al de la tabla al que hace referencia
    protected $primaryKey = 'texto_id';

     /*
        Funcion que trae el folio al que pertenece un determinado texto
    */ 
    public function folio(){

        return $this->belongsTo(Folio::class, 'folio_id', 'folio_id');
    }

    public function libro(){

        return $this->hasOne(Libro::class, 'texto_id', 'texto_id');
    }

    
}
