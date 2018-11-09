<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class LoginTest extends TestCase
{
    //use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_view_login_form()
    {
    	$response = $this->get('/login');

    	$response->assertSuccessful();
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/dashboard');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        // $password = 'i-love-laravel';
        // $user = factory(User::class)->create([
        //     'password' => bcrypt($password),
        //     'email_verified_at' => date('Y-m-d H:i:s')
        // ]);

        // //$this->withoutMiddleware();

        // $response = $this->post('/login', [
        //     'email' => $user->email,
        //     'password' => $password
        // ]);
        // //$response->assertStatus(302);
        // $response->assertRedirect('/login');
        //$this->assertAuthenticatedAs($user);
    }
}
