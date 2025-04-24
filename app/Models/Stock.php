<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',  // Foreign key to the Ingredient table
        'stock_in',       // Quantity of stock added
        'stock_out',      // Quantity of stock removed
        'plan_to_buy',
        'price_per_unit',
        'consumption',
        'closing_stock',
        'remarks',        // Remarks for the stock transaction
        'user_id',        // User associated with the stock transaction
        'processing_pct',
        'packaging_pct',
        'environment_pct',
    ];

    /**
     * Relationship with Ingredient model
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
