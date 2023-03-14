<?php

namespace App\Http\Resources;

use App\Models\Libro;
use Termwind\Components\Li;
use App\Http\Resources\LibroResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'autor_id' => $this->autor_id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'libros' => $this->libros,
        ];
    }
}
