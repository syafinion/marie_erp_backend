<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getCategories()
    {
        $categories = Category::with('ingredients')->get();
        return response()->json(['categories' => $categories]);
    }

    public function updateIngredient(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->only(['is_checked']));
        
        return response()->json(['message' => 'Ingredient updated successfully']);
    }
}
