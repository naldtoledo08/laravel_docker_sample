<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'department-list',
           'department-create',
           'department-edit',
           'department-delete',

           'position-list',
           'position-create',
           'position-edit',
           'position-delete',

           'timesheet-summary',
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}