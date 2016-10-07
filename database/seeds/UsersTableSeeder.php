<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the UsersTableSeeder.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 30)->create();
        
        /*$faker = Faker::create();

        // create two users
        factory(App\User::class, 2)->create([
            'name' => $faker->unique()->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'phone' => $faker->phoneNumber(),
            'registration_date' => $faker->unixTime
        ]);*/
    }
}
