<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Src\App\Auth\Domain\Model\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
	use DatabaseTransactions;

	/** @test **/
	public function a_user_can_login()
	{
		$this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => 'Islam',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ]);

		$response = $this->json('POST', '/api/login', [
            'email' => 'jidul@rootsoftit.com',
            'password' => '123456'
        ]);

        // $this->assertEquals(200, $this->response->status());

        $user = User::first();

        $this->actingAs($user)->get('/api/user');
        // $res = $this->json('GET', '/api/user');
        $this->assertEquals(200, $this->response->status());
	}
}