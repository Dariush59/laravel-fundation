<?php

namespace Database\Seeders;

use App\Models\Companies\Company;
use App\Models\Users\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        User::factory(2)->create();
        Company::factory(2)->create();

    }
}
