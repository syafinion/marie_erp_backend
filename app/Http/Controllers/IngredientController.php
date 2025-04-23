<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Category;

class IngredientController extends Controller
{
    public function listIngredients(Request $request)
    {
        info('Full Request Body:', $request->all());
        $category = $request->input('category');
    
        // Log the incoming request
        info('Incoming request to listIngredients', ['category' => $category]);
    
        // Validate if the category exists
        if (!$category || !is_string($category)) {
            info('Category is missing or invalid in the request');
            return response()->json(['message' => 'Category is required'], 400);
        }
    
        // Trim and standardize category name
        $category = trim($category);
    
        // Fetch category from the database
        $matchedCategory = Category::where('name', $category)->first();
    
        if (!$matchedCategory) {
            info('Category not found in the database', ['category' => $category]);
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Fetch ingredients for the matched category
        $ingredients = Ingredient::where('category_id', $matchedCategory->id)->get();
    
        // Check if ingredients exist
        if ($ingredients->isEmpty()) {
            info('No ingredients found for the category', ['category' => $category]);
            return response()->json(['message' => 'No ingredients found'], 404);
        }
    
        // Format the ingredients
        $formattedIngredients = $ingredients->map(function ($ingredient) {
            return [
                'ingredient' => $ingredient->name,
                'ingredientId' => $ingredient->id,
                'isChecked' => $ingredient->is_checked,
                'measurement' => $ingredient->measurement,
                'isLoose' => $ingredient->is_loose,
                'isCarton' => $ingredient->is_carton,
                'isBag' => $ingredient->is_bag,
                'packageWeight' => $ingredient->package_weight,
                'unitPrice' => $ingredient->unit_price,
                'storageLocation' => $ingredient->storage_location,
                'barcode' => $ingredient->barcode, // Add barcode here
            ];
        })->toArray();
    
        // Return structured response
        $response = [
            'data' => [
                'categoryListing' => [
                    $matchedCategory->name => $formattedIngredients,
                ],
            ],
        ];
    
        info('Fetched ingredients successfully', ['response' => $response]);
    
        return response()->json($response, 200);
    }
    
    public function findIngredientByBarcode(Request $request)
    {
        $barcode = $request->input('barcode');
    
        // Log the incoming request
        \Log::info('findIngredientByBarcode called', ['barcode' => $barcode]);
    
        // Validate the request input
        if (!$barcode || !is_string($barcode)) {
            \Log::warning('Invalid or missing barcode', ['barcode' => $barcode]);
            return response()->json(['message' => 'Barcode is required'], 400);
        }
    
        // Search for the ingredient with the provided barcode
        $ingredient = Ingredient::where('barcode', $barcode)->first();
    
        if (!$ingredient) {
            \Log::warning('Ingredient not found for barcode', ['barcode' => $barcode]);
            return response()->json(['message' => 'Ingredient not found'], 404);
        }
    
        // Format the response with ingredient details
        $response = [
            'data' => [
                'ingredientId' => $ingredient->id,
                'ingredient' => $ingredient->name,
                'barcode' => $ingredient->barcode,
                'measurement' => $ingredient->measurement,
                'unitPrice' => $ingredient->unit_price,
                'storageLocation' => $ingredient->storage_location,
                'category' => $ingredient->category->name ?? null, // Include category name if available
                'isChecked' => $ingredient->is_checked,
                'isLoose' => $ingredient->is_loose,
                'isCarton' => $ingredient->is_carton,
                'isBag' => $ingredient->is_bag,
                'packageWeight' => $ingredient->package_weight,
            ],
        ];
    
        \Log::info('Ingredient found for barcode', ['response' => $response]);
    
        return response()->json($response, 200);
    }
    

public function updateIngredientBarcode(Request $request)
{
    $ingredientId = $request->input('ingredientId');
    $barcode = $request->input('barcode');

    // Log the incoming request
    \Log::info('updateIngredientBarcode called', [
        'ingredientId' => $ingredientId,
        'barcode' => $barcode,
    ]);

    if (!$ingredientId || !$barcode) {
        \Log::warning('Ingredient ID and barcode are required');
        return response()->json(['message' => 'Ingredient ID and barcode are required'], 400);
    }

    $ingredient = Ingredient::find($ingredientId);

    if (!$ingredient) {
        \Log::warning('Ingredient not found', ['ingredientId' => $ingredientId]);
        return response()->json(['message' => 'Ingredient not found'], 404);
    }

    $ingredient->barcode = $barcode;
    $ingredient->save();

    \Log::info('Barcode updated successfully', ['ingredientId' => $ingredientId]);

    return response()->json(['message' => 'Barcode updated successfully'], 200);
}



public function createIngredient(Request $request)
{
    // Decode the raw input
    $inputData = json_decode($request->getContent(), true);
    $data = $inputData['ingredientsData'][0] ?? null;

    // Validate required fields
    if (!$data || empty($data['ingredient']) || empty($inputData['category'])) {
        return response()->json(['message' => 'Missing required ingredient fields'], 400);
    }

    // Fetch category ID from category name
    $category = Category::where('name', $inputData['category'])->first();

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Create or update the ingredient with new fields, including barcode and item_code
    $ingredient = Ingredient::updateOrCreate(
        [
            'name' => $data['ingredient'],
            'category_id' => $category->id,
        ],
        [
            'is_checked' => $data['isChecked'] ?? false,
            'measurement' => $data['measurement'] ?? null,
            'is_loose' => $data['isLoose'] ?? false,
            'is_carton' => $data['isCarton'] ?? false,
            'is_bag' => $data['isBag'] ?? false,
            'package_weight' => $data['packageWeight'] ?? null,
            'unit_price' => $data['unitPrice'] ?? null,
            'storage_location' => $data['storageLocation'] ?? null,
            'barcode' => $data['barcode'] ?? null, // Existing barcode field
            'item_code' => $data['itemCode'] ?? null, // New item_code field added here
        ]
    );

    return response()->json([
        'message' => 'Ingredient created or updated successfully',
        'ingredientId' => $ingredient->id, // Return the ingredient ID
    ], 200);
}






public function editIngredient(Request $request)
{
    // Extract data
    $data = $request->input('data')[0] ?? null;

    // Ensure data is provided
    if (!$data || empty($data['ingredientId'])) {
        return response()->json(['message' => 'Ingredient ID is required'], 400);
    }

    // Find the ingredient or return a 404 error
    $ingredient = Ingredient::find($data['ingredientId']);

    if (!$ingredient) {
        return response()->json(['message' => 'Ingredient not found'], 404);
    }

    // Update the ingredient fields with new fields
    $ingredient->update([
        'name' => $data['ingredient'] ?? $ingredient->name,
        'is_checked' => $data['isChecked'] ?? $ingredient->is_checked,
        'measurement' => $data['measurement'] ?? $ingredient->measurement,
        'is_loose' => $data['isLoose'] ?? $ingredient->is_loose,
        'is_carton' => $data['isCarton'] ?? $ingredient->is_carton,
        'is_bag' => $data['isBag'] ?? $ingredient->is_bag,
        'package_weight' => $data['packageWeight'] ?? $ingredient->package_weight,
        'unit_price' => $data['unitPrice'] ?? $ingredient->unit_price,
        'storage_location' => $data['storageLocation'] ?? $ingredient->storage_location,
    ]);

    return response()->json(['message' => 'Ingredient updated successfully'], 200);
}



    public function saveIngredients(Request $request)
    {
        $ingredientsData = $request->input('data');
        foreach ($ingredientsData as $ingredientData) {
            Ingredient::updateOrCreate(
                ['id' => $ingredientData['ingredientId']],
                $ingredientData
            );
        }

        return response()->json(['message' => 'Ingredients saved successfully']);
    }
}
