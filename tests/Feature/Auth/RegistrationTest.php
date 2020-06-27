<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Src\App\Auth\Domain\Model\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function a_user_can_register()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => 'Islam',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ])->seeJson([
            'status' => true
        ]);

        $this->assertEquals(201, $this->response->status());
        $this->assertCount(1, User::all());
    }

    /** @test **/
    public function a_first_name_is_required()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => '',
            'last_name' => 'Islam',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'first_name' => ['The first name field is required.']
            ]
        ]);
    }

    /** @test **/
    public function a_first_name_can_have_max_100_characters()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
            'last_name' => 'Islam',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'first_name' => ['The first name may not be greater than 100 characters.']
            ]
        ]);
    }

    /** @test **/
    public function a_last_name_can_have_max_100_characters()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => 'ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'last_name' => ['The last name may not be greater than 100 characters.']
            ]
        ]);
    }


    /** @test **/
    public function a_last_name_is_required()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => '',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'last_name' => ['The last name field is required.']
            ]
        ]);
    }

    /** @test **/
    public function a_email_is_required()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => 'Islam',
            'email' => '',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'email' => ['The email field is required.']
            ]
        ]);
    }

    /** @test **/
    public function a_email_is_unique()
    {
        $this->a_user_can_register();

        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => 'Islam',
            'email' => 'jidul@rootsoftit.com',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'email' => ['The email has already been taken.']
            ]
        ]);
    }

    /** @test **/
    public function a_email_can_have_max_100_characters()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Jidul',
            'last_name' => 'Islam',
            'email' => 'ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd@rootsoftit.com',
            'password' => 123456
        ])->seeJsonEquals([
            'status' => false,
            'errors' => [
                'email' => ['The email may not be greater than 100 characters.']
            ]
        ]);
    }
}
