<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition()
    {
        return [
            'user_id'       => User::factory(),
            'category_id'   => Category::factory(),
            'name'          => $this->faker->word(),
            'barcode'       => $this->faker->unique()->numerify('############3'), // 13 digits
            'is_checked'    => $this->faker->boolean(),
            'is_loose'      => $this->faker->boolean(),
            'is_carton'     => $this->faker->boolean(),
            'is_bag'        => $this->faker->boolean(),
            'package_weight'=> $this->faker->randomFloat(2, 0.1, 5).'kg',
            'unit_price'    => $this->faker->randomFloat(2, 1, 100),
            'storage_location' => $this->faker->word(),
            'item_code'     => $this->faker->bothify('ITEM-###'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
