<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    protected $roles = [
        'super-admin',
        'Admin',
        'Staff',
        'Reader',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $name) {
            DB::table('roles')->insert([
                'name' => $name,


            ]);
        };

    }
}
