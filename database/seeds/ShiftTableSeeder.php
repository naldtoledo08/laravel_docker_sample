<?php

use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::insert([
        	[
    			'name' => 'Day Shift',
    			'description' => '7am to 11 am',
			],
        	[
    			'name' => 'Mid-Day',
    			'description' => '12pm to 5pm',
			],
        	[
    			'name' => 'Night',
    			'description' => '6pm to 12am',
			],
		]);
    }
}
