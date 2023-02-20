<?php

namespace App\Dto;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;

class CompanyData implements Arrayable, Jsonable
{
    public function __construct(
        public readonly User   $creator,
        public readonly string $businessName,
        public readonly string $address,
        public readonly string $vat,
        public readonly string $taxCode,
        public readonly int    $employees,
        public readonly bool   $active,
        public readonly int    $type // I've done it simple with an `int` but it should be an Enum.
    ) {
    }

    public static function newInstanceFrom(array $data, User $user): self
    {
        return new self(
            creator: $user,
            businessName: Arr::get($data, 'businessName'),
            address: Arr::get($data, 'address'),
            vat: Arr::get($data, 'vat'),
            taxCode: Arr::get($data, 'taxCode'),
            employees: Arr::get($data, 'employees'),
            active: Arr::get($data, 'active', false),
            type: Arr::get($data, 'type')
        );
    }

    public function toArray(): array
    {
        return [
            'business_name' => $this->businessName,
            'address' => $this->address,
            'vat' => $this->vat,
            'tax_code' => $this->taxCode,
            'employees' => $this->employees,
            'active' => $this->active,
            'type' => $this->type
        ];
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }
}
