<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    //Se define el nombre de la tabla que debe de ser el mismo al de la base de datos al que hace referencia
    protected $table = 'libro';
    //Se define el nombre de la llave primaria que debe de ser igual al de la tabla al que hace referencia
    protected $primaryKey = 'libro_id';

    public function autor(){

        return $this->belongsTo(Autor::class, 'autor_id', 'autor_id');
    }

}
