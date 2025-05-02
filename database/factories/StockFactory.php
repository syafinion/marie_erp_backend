<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition()
    {
        return [
            'ingredient_id'  => Ingredient::factory(),
            'stock_in'       => $this->faker->numberBetween(0, 50),
            'stock_out'      => 0,
            'remarks'        => $this->faker->sentence(),
            'user_id'        => User::factory(),
            'plan_to_buy'    => 0,
            'price_per_unit' => 0,
            'consumption'    => 0,
            'closing_stock'  => $this->faker->numberBetween(0, 50),
            'processing_pct' => $this->faker->numberBetween(0,100),
            'packaging_pct'  => $this->faker->numberBetween(0,100),
            'environment_pct'=> $this->faker->numberBetween(0,100),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
