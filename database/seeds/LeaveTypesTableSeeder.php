<?php

use Illuminate\Database\Seeder;
use App\Models\leaveType;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        leaveType::insert([
        	[
				'name' => 'Sick Leave',
				'code' => 'SL',
				'description' => 'Sick Leave',
			],
        	[
				'name' => 'Vacation Leave',
				'code' => 'VL',
				'description' => 'Vacation Leave',
			],
        	[
				'name' => 'Emergency Leave',
				'code' => 'EL',
				'description' => 'Emergency Leave',
			]
		]);
    }
}
