<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class ShowRecipeApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAccessorTest()
    {
        $response = $this->json('get', 'api/show/recipe/3');

        dd($response);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

    }
}
