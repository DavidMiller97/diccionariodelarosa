<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    //Se define el nombre de la tabla que debe de ser el mismo al de la base de datos al que hace referencia
    protected $table = 'pais';
    //Se define el nombre de la llave primaria que debe de ser igual al de la tabla al que hace referencia
    protected $primaryKey = 'pais_id';
}
