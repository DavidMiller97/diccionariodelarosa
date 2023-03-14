<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    //Se define el nombre de la tabla que debe de ser el mismo al de la base de datos al que hace referencia
    protected $table = 'autor';
    //Se define el nombre de la llave primaria que debe de ser igual al de la tabla al que hace referencia
    protected $primaryKey = 'autor_id';

    public function texto(){

        return $this->belongsTo(Texto::class, 'texto_id', 'texto_id');
    }

    public function libros(){

        return $this->hasMany(Libro::class, 'autor_id', 'autor_id');
    }
}
