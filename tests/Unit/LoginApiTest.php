<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class LoginApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAccessorTest()
    {
        $response = $this->json('post', 'api/login', ['email'=>'123456@mail.ru', 'password' => '12345464789']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

    }
}
