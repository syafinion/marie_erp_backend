<?php

/*
 * File: Stock.php
 * Project: Marie ERP
 * Created Date: March 2025
 * 
 * Copyright (c) 2025 Group 17
 * 
 * Authors:
 * - Syafiq - Group 17
 * 
 * Description:
 * Model representing stock transactions and inventory management in the Marie ERP system.
 * Handles stock movements, planning, and wastage calculations using Eloquent ORM.
 * 
 * Features:
 * - Stock in/out tracking
 * - Purchase planning
 * - Price per unit tracking
 * - Consumption monitoring
 * - Closing stock calculation
 * - Wastage percentage tracking
 *   - Processing waste
 *   - Packaging waste
 *   - Environmental waste
 * 
 * Database Fields:
 * - ingredient_id: Foreign key to ingredients table
 * - stock_in: Quantity added to inventory
 * - stock_out: Quantity removed from inventory
 * - plan_to_buy: Planned purchase quantity
 * - price_per_unit: Cost per unit
 * - consumption: Usage quantity
 * - closing_stock: Remaining stock
 * - remarks: Transaction notes
 * - user_id: Foreign key to users table
 * - processing_pct: Processing wastage percentage
 * - packaging_pct: Packaging wastage percentage
 * - environment_pct: Environmental wastage percentage
 * 
 * Relationships:
 * - belongs to Ingredient
 * - belongs to User
 * 
 * Modified/Adapted From:
 * - Laravel Eloquent Model patterns
 *   Source: https://laravel.com/docs/eloquent
 */


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
        'user_id',
    ];

    /**
     * Relationship with Ingredient model
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function user()
   {
       return $this->belongsTo(User::class);
   }
}
