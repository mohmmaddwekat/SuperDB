<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilitySeeder extends Seeder
{
    protected $abilities =[


        'super-db.connection.index' => 'can show connections',
        'super-db.connection.delete' => 'can delete connections',
        'super-db.connection.add' => 'can add connections',
        'super-db.jobs.index' => 'can show tables of connection',
        'super-db.jobs.view-column' => 'can show table',
        'super-db.jobs.delete-table' => 'can delete table',
        'super-db.jobs.delete-column' => 'can delete column',
        'super-db.dashboard' => 'can show dashboard',
        'super-db.db.export' => 'can export',
        'super-db.import.index' => 'can show import page',
        'super-db.import.add' => 'can add import',
        'super-db.inserts.index' => 'can show inserts page',
        'super-db.inserts.store' => 'can insert',
        'super-db.inserts.rename-column' => 'can rename coumn',
        'super-db.inserts.update-column' => 'can .update column',
        'super-db.inserts.rename-table' => 'can rename tabl',
        'super-db.inserts.updateTable' => 'can update Table',
        'super-db.sqls.index' => 'can show page sql',
        'super-db.sqls.store' => 'can store query',
        'super-db.jobs.versionControl' => 'can make snapshot',
        'super-db.versionControl.index' => 'can show all snapshot you make',
        'super-db.versionControl.store' => 'sxs',
        'super-db.versionControl.update' => 'sxs',
        'users.register' => 'can show register page',
        'users.store' => 'can store new user',
        'super-db.roles.index'  =>'can show roles',
        'super-db.roles.create' =>'can create roles',
        'super-db.roles.store' =>'can store roles',
        'super-db.roles.edit' =>'can edit roles',
        'super-db.roles.update' =>'can update roles',
        'super-db.roles.destory' =>'can delete roels',
        'super-db.abilities.create' =>'can add abilites',
        'super-db.abilities.store' =>'can store abilites',
        'super-db.abilities.edit' =>'can edit abilites',
        'super-db.abilities.update' =>'can update abilites',

        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->abilities as $code => $explain){
            DB::table('abilities')->insert([
                'code' => $code,
                'explain' => $explain
            ]);
        };
    }
}
