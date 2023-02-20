<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            // 'id' => $this->id, // Avoid passing IDs back as response... better use slugs when possible!
            'businessName' => $this->businessName,
            'address' => $this->address,
            'vat' =>  $this->vat,
            'taxCode' => $this->taxCode,
            'employees' => $this->employees,
            'active' => $this->active,
            'type' => $this->type,
            'creator' => $this->whenLoaded('creator', new UserResource($this->creator)),
        ];
    }
}
