<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Available Roles
     * 
     * @var array
     */
    protected $addRoles = [
        'administrator' => 'Site Administrator',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->addRoles as $name => $label) {
            App\Models\Role::create([
                'name' => $name,
                'label' => $label,
            ]);
        }
    }
}
