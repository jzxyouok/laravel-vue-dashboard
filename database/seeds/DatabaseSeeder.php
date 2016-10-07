<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Tables to truncate before seeding
     * 
     * @var array
     */
    protected $toTruncate = [
        'users',
        'roles', 
        'permissions',
        'permission_role',
        'role_user',
        'companies',
        'projects',
        'tasks',
        'teams',
        'team_user',
        'password_resets'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key check for this connection before truncating tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        
        // Enable foreign key check for this connection after truncating tables
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        // $this->call(CompaniesTableSeeder::class);
    }
}
