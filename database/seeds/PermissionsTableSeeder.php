<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Available Permissions
     * 
     * @var array
     */
    protected $addPermissions = [
        'assign_tasks' => 'Assign Tasks',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->addPermissions as $name => $label) {
            App\Models\Permission::create([
                'name' => $name,
                'label' => $label,
            ]);
        }
    }
}
