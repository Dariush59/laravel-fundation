<?php

namespace Database\Factories\Users;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'        => $this->faker->firstName,
            'last_name'         => $this->faker->lastName,
            'phone_no'          => $this->faker->phoneNumber,
            'role_type'         => false,
            'last_login'        => $this->faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'joined_at'         => $this->faker->dateTimeThisDecade($max = 'now', $timezone = null),
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}



