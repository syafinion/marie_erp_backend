<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class IngredientApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_ingredient()
    {
        Category::factory()->create(['name' => 'Vegetables']);

        $payload = [
            'ingredientsData' => [[
                'ingredient'      => 'Lettuce',
                'barcode'         => 'ABC123',
                'packageWeight'   => 5,
                'unitPrice'       => 1.2,
                'storageLocation' => 'Cold Room',
            ]],
            'category' => 'Vegetables',
        ];

        $response = $this->postJson('/api/createIngredient', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'ingredientId']);

        $this->assertDatabaseHas('ingredients', [
            'barcode' => 'ABC123',
        ]);
    }

    /** @test */
    public function missing_fields_return_an_error()
    {
        $response = $this->postJson('/api/createIngredient', []);

        $response->assertStatus(400)
                 ->assertJson(['message' => 'Missing required ingredient fields']);
    }
}
