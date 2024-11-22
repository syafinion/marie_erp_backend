<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = ['ingredient_id', 'measurement_id', 'measurement'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
