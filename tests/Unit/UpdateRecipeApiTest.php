<?php
// tests/Unit/AccessorTest.php
namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class UpdateRecipeApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessorTest()
    {
        $response = $this->json('put', 'api/recipes/3/update', ['title'=> 'recipeNew', 'description'=>'Описание для нового рецепта','code' => 'let a = x;',]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

    }
}
