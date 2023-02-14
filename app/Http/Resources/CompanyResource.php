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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'businessName' => $this->businessName,
            'address' => $this->address,
            'vat' =>  $this->vat,
            'taxCode' => $this->taxCode,
            'employees' => $this->employees,
            'active' => $this->active,
            'type' => $this->type,
            'user' => $this->user,
            'meta' => [
                'page' => $request->query('page', 0),
                'perPage' => $request->query('perPage', 0),
            ]
        ];
    }
}
