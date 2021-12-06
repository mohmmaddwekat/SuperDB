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
            AbilitySeeder::class,
            RoleSeeder::class,
            
        ]);

        $ranges = range(1,31);
        Role::find(1)->abilities()->attach($ranges); 
        
        Role::find(2)->abilities()->attach($ranges); 

        $ranges = [1, 3, 4 ,5 ,8 ,9 ,10, 11, 12 ,13, 14 ,15 ,16, 17, 18 ,19];
        Role::find(3)->abilities()->attach($ranges);

        $ranges = [1,4,5,8,9];
        Role::find(4)->abilities()->attach($ranges);
    }
}
