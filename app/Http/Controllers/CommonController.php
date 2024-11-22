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

        return response()->json([
            'categories' => $categories->map(function ($category) {
                return [
                    'category' => $category->name,
                    'ingredients' => $category->ingredients->map(function ($ingredient) {
                        return [
                            'id' => $ingredient->id,
                            'name' => $ingredient->name,
                            'is_checked' => $ingredient->is_checked,
                        ];
                    }),
                ];
            }),
        ]);
    }

    public function updateIngredient(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->only(['is_checked']));
        
        return response()->json(['message' => 'Ingredient updated successfully']);
    }

    public function commonDataGet(Request $request)
    {
        $userId = $request->input('userId');

        // Mock response data for the requested user
        $response = [
            'Data' => [
                [
                    'restaurantName' => 'My Restaurant', // Example data
                    'currency' => 'USD',
                ]
            ]
        ];

        // Example: Write user-specific currency to session or log
        return response()->json($response);
    }
}
