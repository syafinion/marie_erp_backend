<?php

/*
 * File: Ingredient.php
 * Project: Marie ERP
 * Created Date: March 2025
 * 
 * Copyright (c) 2025 Group 17
 * 
 * Authors:
 * - Syafiq - Group 17
 * 
 * Description:
 * Model representing ingredients in the Marie ERP system.
 * Handles ingredient data structure and relationships with other models.
 * Implements Eloquent ORM for database interactions.
 * 
 * Features:
 * - Ingredient categorization
 * - Multiple packaging types (loose/carton/bag)
 * - Barcode tracking
 * - Storage location management
 * - Price tracking
 * - User association
 * - Measurement units
 * 
 * Database Fields:
 * - category_id: Foreign key to categories table
 * - name: Ingredient name
 * - is_checked: Boolean for selection status
 * - measurement: Unit of measurement
 * - is_loose/is_carton/is_bag: Packaging type flags
 * - package_weight: Weight per package
 * - unit_price: Price per unit
 * - storage_location: Storage location identifier
 * - barcode: Unique barcode identifier
 * - item_code: Internal item code
 * - user_id: Foreign key to users table
 * 
 * Relationships:
 * - belongs to Category
 * - belongs to User
 * 
 * Modified/Adapted From:
 * - Laravel Eloquent Model patterns
 *   Source: https://laravel.com/docs/eloquent
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'is_checked',
        'measurement',
        'is_loose',
        'is_carton',
        'is_bag',
        'package_weight',
        'unit_price',
        'storage_location',
        'barcode', // Add barcode to fillable
        'item_code',
        'user_id',
    ];

    protected $casts = [
        'is_checked' => 'boolean',
        'is_loose' => 'boolean',
        'is_carton' => 'boolean',
        'is_bag' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
   {
       return $this->belongsTo(User::class);
   }
}
