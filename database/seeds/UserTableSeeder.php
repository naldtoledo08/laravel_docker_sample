<?php

use Illuminate\Database\Seeder;
use App\Models\User;
//use Spatie\Permission\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{

		User::create([
			'name' => 'Ronald Toledo',
			'email' => 'nald.toledo08@gmail.com',
            'password' => '$2y$10$ODXv1BScQnJrzaFed23RV.jCLui9weJjhb5RSHfLyZJXwco5jHpeu',
            'department_id' => 1,
			'position_id' => 1,
            'email_verified_at' => date('Y-m-d H:i:s');
		]);

    }
}