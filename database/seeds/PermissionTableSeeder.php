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
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',

           'timesheet-list',
           'timesheet-create',
           'timesheet-edit',
           'timesheet-delete',

           'department-list',
           'department-create',
           'department-edit',
           'department-delete',

           'position-list',
           'position-create',
           'position-edit',
           'position-delete',
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}