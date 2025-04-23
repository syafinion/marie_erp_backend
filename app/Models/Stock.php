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
        'remarks',        // Remarks for the stock transaction
        'user_id',        // User associated with the stock transaction
    ];

    /**
     * Relationship with Ingredient model
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
