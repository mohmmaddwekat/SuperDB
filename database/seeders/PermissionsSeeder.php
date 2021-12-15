<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    protected $permissions =[


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
        'super-db.inserts.add-row' => 'show add row page',
        'super-db.inserts.store-row' => 'add store new row for data of table',
        'super-db.jobs.versionControl' => 'can make snapshot',
        'super-db.versionControl.index' => 'can show all snapshot you make',
        'super-db.versionControl.store' => 'can make snapshot',
        'super-db.versionControl.update' => 'Update the data in the table',
        'users.register' => 'can show register page',
        'users.store' => 'can store new user',
        'super-db.roles.index'  =>'can show roles',
        'super-db.roles.create' =>'can create roles',
        'super-db.roles.store' =>'can store roles',
        'super-db.roles.edit' =>'can edit roles',
        'super-db.roles.update' =>'can update roles',
        'super-db.roles.destroy' =>'can delete roels',
        'super-db.permissions.create' =>'can add abilites',
        'super-db.permissions.store' =>'can store abilites',
        'super-db.permissions.edit' =>'can edit abilites',
        'super-db.permissions.update' =>'can update abilites',

        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->permissions as $code => $explain){
            DB::table('permissions')->insert([
                'code' => $code,
                'explain' => $explain
            ]);
        };
    }
}
