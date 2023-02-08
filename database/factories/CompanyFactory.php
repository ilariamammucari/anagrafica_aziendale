<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => Auth::id(),
            'businessName' => $this->faker->company,
            'address' => $this->faker->company,
            'vat' =>  '01234567891',
            'taxCode' => $this->faker->regexify('[A-Z]{6}[0-4]{5}'),
            'employees' => $this->faker->randomNumber(3, false),
            'active' => 1,
            'type' => 1,
        ];
    }
}
