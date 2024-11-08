<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            ['category_id' => 1, 'name' => 'Carrot', 'is_checked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Potato', 'is_checked' => true, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Apple', 'is_checked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Banana', 'is_checked' => true, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Milk', 'is_checked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Cheese', 'is_checked' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
