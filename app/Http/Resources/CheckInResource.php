<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckInResource extends JsonResource
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
            'no_document' => $this->no_document,
            'kuantum' => $this->kuantum,
            'driver_name' => $this->driver_name,
            'vehicle_plat' => $this->vehicle_plat,
            'container_number' => $this->container_number,
            'document_type' => $this->document_type,
            'images' => [
                'identity_card' => $this->image_identity_card,
                'front_truck' => $this->image_front_truck,
            ]
        ];
    }
}
