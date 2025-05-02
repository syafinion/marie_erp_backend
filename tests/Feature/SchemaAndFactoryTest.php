<?php

/*
 * File: SchemaAndFactoryTest.php
 * Project: Marie ERP
 * Created Date: March 2025
 * 
 * Copyright (c) 2025 Group 17
 * 
 * Authors:
 * - Syafiq - Group 17
 * 
 * Description:
 * Database schema and factory tests for the Marie ERP system.
 * Validates database structure and tests model factories.
 * 
 * Test Categories:
 * - Database Schema Validation
 * - Factory Testing
 * - Data Generation
 * 
 * Test Cases:
 * - Core table existence
 * - Factory record creation
 * - Multiple record generation
 * 
 * Dependencies:
 * - RefreshDatabase trait
 * - Schema facade
 * - Ingredient model
 * 
 * Modified/Adapted From:
 * - Laravel Database Testing
 *   Source: https://laravel.com/docs/database-testing
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use App\Models\Ingredient;

class SchemaAndFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_core_tables_exist()
    {
        $tables = [
            'users',
            'categories',
            'ingredients',
            'stocks',
        ];

        foreach ($tables as $table) {
            $this->assertTrue(
                Schema::hasTable($table),
                "Expected table '{$table}' to exist"
            );
        }
    }

    /** @test */
    public function ingredient_factory_can_create_multiple_records()
    {
        Ingredient::factory()->count(5)->create();

        $this->assertDatabaseCount('ingredients', 5);
    }
}
