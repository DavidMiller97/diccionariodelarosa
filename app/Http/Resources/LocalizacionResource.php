<?php

namespace App\Http\Resources;

use App\Models\Pais;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalizacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $pais = new PaisResource(Pais::find($this->pais_id));

        return [

            'localizacion_id' => $this->localizacion_id,
            'pais' => $this->when(isset($pais), $pais),
            'nombre' => $this->nombre,
            'direccion_url' => $this->direccion_url

        ];
    }
}
