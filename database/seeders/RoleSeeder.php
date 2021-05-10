<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    const roles = [
        ['name' => 'president'],
        ['name' => 'boss'],
        ['name' => 'contributor'],
        [ 'name' => 'president' ],
        [ 'name' => 'boss' ],
        [ 'name' => 'contributor' ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->createMany(RoleSeeder::roles);
    }
}
