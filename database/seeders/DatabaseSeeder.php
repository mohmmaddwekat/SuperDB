<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
         User::factory(1)->create();
         $this->call([
            PermissionsSeeder::class,
            RoleSeeder::class,
            
        ]);

        $ranges = range(1,35);
        Role::find(1)->permissions()->attach($ranges); 
        
        Role::find(2)->permissions()->attach($ranges); 

        $ranges = [1, 3, 4 ,5 ,8 ,9 ,10, 11, 12 ,13, 14 ,15 ,16, 17, 18 ,19,20,21,22,23];
        Role::find(3)->permissions()->attach($ranges);

        $ranges = [1,4,5,8,9];
        Role::find(4)->permissions()->attach($ranges);
    }
}
