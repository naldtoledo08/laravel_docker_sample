<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EmployeeSchedule;
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

		$user = User::create([
            'firstname' => 'Ronald',
			'lastname' => 'Toledo',
			'email' => 'nald.toledo08@gmail.com',
            'password' => '$2y$10$ODXv1BScQnJrzaFed23RV.jCLui9weJjhb5RSHfLyZJXwco5jHpeu',
            'department_id' => 1,
            'position_id' => 1,
			'slug' => 'ronald-toledo',
            'email_verified_at' => date('Y-m-d H:i:s')
		]);

        EmployeeSchedule::create([
            'user_id' => $user->id,
            'type' => 'fixed',
            'from' => '6:00:00',
            'from_flex' => '12:00:00',
            'to' => '15:00:00',
            'to_flex' => '21:00:00',
            'shift_id' => 1
        ]);

        $users = factory(App\Models\User::class, 15)->create();

        foreach ($users as $user) {
            EmployeeSchedule::create([
                'user_id' => $user->id,
                'type' => 'fixed',
                'from' => '6:00:00',
                'from_flex' => '12:00:00',
                'to' => '15:00:00',
                'to_flex' => '21:00:00',
                'shift_id' => 1
            ]);

        }
        

    }
}