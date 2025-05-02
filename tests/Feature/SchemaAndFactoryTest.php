<?php

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
