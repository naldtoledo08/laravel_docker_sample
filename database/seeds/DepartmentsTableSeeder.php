<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{

		Department::create([
			'name' => 'Human Resources',
			'description' => 'HR',
		]);

    }
}