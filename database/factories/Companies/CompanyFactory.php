<?php

namespace Database\Factories\Companies;

use App\Models\Companies\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->company,
            'house_no'          => $this->faker->numberBetween($min = 1, $max = 999),
            'street_address'    => $this->faker->address,
            'city'              => $this->faker->city,
            'country'           => $this->faker->company,
            'phone_no'          => $this->faker->phoneNumber,
            'vat_no'            => $this->faker->numberBetween($min = 1111111, $max = 9999999),
            'status'            => $this->faker->boolean,
        ];
    }
}



