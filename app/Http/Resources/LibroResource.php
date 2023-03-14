<?php

namespace App\Http\Resources;

use App\Models\Autor;
use App\Models\Marca;
use App\Models\Estante;
use App\Models\Localizacion;
use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $autor = new AutorResource(Autor::find($this->autor_id));
        $localizacion = new LocalizacionResource(Localizacion::find($this->localizacion_id));
        $marca = new MarcaResource(Marca::find($this->marca_id));
        $estante = new EstanteResource(Estante::find($this->estante_id));

        return [

            'libro_id' => $this->libro_id,
            'folio_id' => $this->folio_id,
            'texto_id' => $this->texto_id,
            'autor' => $this->when(isset($autor), $autor),
            'nombre' => $this->nombre,
            'noInventario' => $this->when(isset($this->noInventario), $this->noInventario),
            'noPaginas' => $this->when(isset($this->noPaginas), $this->noPaginas),
            'localizacion' => $this->when(isset($localizacion), $localizacion),
            'marca' => $this->when(isset($marca), $marca),
            'estante' => $this->when(isset($estante), $estante),
            
        ];
    }
}
