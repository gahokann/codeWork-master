<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class DestroyApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAccessorTest()
    {
        $tokenUser = $this->json('post', 'api/login', ['email'=>'123456@mail.ru', 'password' => '12345464789']);

        $token = $tokenUser['data']['token'];

        // $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDUzZmQ0ZTFmN2MzMDQ5N2I3MTA1NjczYTE4YzQ4MzA0ZmFiMmEyMjU1MzFkNmY4ZWQwNGQzZDlmMjJkZTY5NzZmOTkwNWMxMjBjZTFlZmIiLCJpYXQiOjE2Njk2MzA5NjEuNDM1MjcyLCJuYmYiOjE2Njk2MzA5NjEuNDM1Mjc0LCJleHAiOjE3MDExNjY5NjEuMzkwMjgxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.kQG9y9hPCLy0s_KvrGtF6dzHQfLxIpXPNxP1IW9iIFL1BvzTiK2DKfGita8ijOID99NTs4Jcn1XwDjlkNZMypTBXOqQabOy_1RCow1q92-lSyRKQ2RbBoRDDQWeN_QIzPoUVVt-hL-vAnz-Dm0KYQkV_fQvmhNhOrd4le_gTy8-C6yWQySJvy61ebmQZWh7LjEwfQ3oSi6-hNVHtGbp3Q_8XrtichxdoK7wibkfrHszEYsqEpGNcKgbCOhRCfpSZsPmofK0qU9ta4LpxLYcSH_AMe5hn_y7hIM27Y0-9RsAB5spnugRrcIpPY_QpHEKoSwwqgSyUDDggQDe9NBlY5ACwmzrNOL9Qkwc0ZG4z31PtnHSx9TxSD0CFMtVKgtzymLQaayZKmdyKJdJ49qzJvAbb2LOCtwVOfXzQ--tAHf6CGoARAApnAOcNEZ8FDhAr9fZ22ZJHj3ZrMEReGrV8X_yR_HG6bSRSHL5CaAkXOkUVA-lFFpeFhmVrJC_jST9ft5vkA1mwzHscvIw6kmazVyM9D6RL9ZK3aiIzAnUTWFpz-UbMkhIW6gtjzglVveA6dv0OkK1nd-hhzvZpIgKvFeO37uQ-TgrsgSR0NeY_LQOv7Wj2CtC9XHIM9WN9tfTCQY58bdtKoRznydxh-hs9hs6mNnj3aHlhG5qhRHRWSL4';

        $response = $this->json('get', 'api/user/11/destroy',
            [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

    }
}
