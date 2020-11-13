<?php
namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'phone_no'          => $faker->phoneNumber,
            'role_type'         => true,
            'last_login'        => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'joined_at'         => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
            'email'             => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => bcrypt('password'), 
            'remember_token' => Str::random(10),
        ]);

    }
}
