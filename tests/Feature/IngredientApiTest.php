<?php
/*
 * File: api.php
 * Project: Marie ERP
 * Created Date: March 2025
 * 
 * Copyright (c) 2025 Group 17
 * 
 * Authors:
 * - Syafiq - Group 17
 * 
 * Description:
 * API route definitions for the Marie ERP system.
 * Defines all endpoints for authentication, ingredient management,
 * stock management, and common data operations.
 * 
 * Route Groups:
 * - Authentication Routes (/login, /register)
 * - Ingredient Management Routes (/ingredients/*)
 * - Stock Management Routes (/stocks/*)
 * - Common Data Routes (/common, /categories)
 * - Storage Location Routes (/storage-locations)
 * 
 * Protected Routes:
 * - User data access (auth:sanctum middleware)
 * 
 * HTTP Methods Used:
 * - GET: Data retrieval
 * - POST: Data creation and complex queries
 * - PUT: Data updates
 * - DELETE: Data removal
 * 
 * Controllers Used:
 * - AuthController: User authentication
 * - CommonController: Shared functionality
 * - IngredientController: Ingredient management
 * - StockController: Stock management
 * 
 * Modified/Adapted From:
 * - Laravel Routing documentation
 *   Source: https://laravel.com/docs/routing
 * - Laravel API Authentication
 *   Source: https://laravel.com/docs/authentication
 */

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
