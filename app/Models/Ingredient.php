<?php

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
