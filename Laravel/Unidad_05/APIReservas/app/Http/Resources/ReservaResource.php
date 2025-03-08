<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'empleado' => $this->empleado,
            'fechaI' => $this->fechaI,
            'fechaF' => $this->fechaF,
            'recurso' => $this->recurso->nombre
        ];
    }
}
