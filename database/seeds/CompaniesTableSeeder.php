<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the CompaniesTableSeeder.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Company::class, 250)->create();
    }
}
