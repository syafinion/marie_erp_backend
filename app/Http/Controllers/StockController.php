<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient; 
use App\Models\Stock;

class StockController extends Controller
{
    public function listStocks(Request $request)
    {
        $stocks = Stock::all();

        return response()->json(['stocks' => $stocks]);
    }

    public function createStock(Request $request)
    {
        $stock = Stock::create($request->all());

        return response()->json(['message' => 'Stock created successfully', 'stock' => $stock]);
    }

    public function editStock(Request $request)
    {
        $stock = Stock::findOrFail($request->input('stockId'));
        $stock->update($request->input('ingredientsData'));

        return response()->json(['message' => 'Stock updated successfully']);
    }

    public function deleteStock(Request $request)
    {
        $stock = Stock::findOrFail($request->input('stockId'));
        $stock->delete();

        return response()->json(['message' => 'Stock deleted successfully']);
    }

    public function selectStock(Request $request)
    {
        $userId = $request->input('userId');

        $categories = Category::with('ingredients')->get();

        $response = [
            'selectedData' => $categories->map(function ($category) {
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
        ];

        return response()->json($response);
    }

    public function downloadStockCard(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Mock download data
        $response = [
            'stockData' => [
                'date_range' => "$fromDate to $toDate",
                'items' => [
                    ['name' => 'Carrot', 'quantity' => 100, 'price' => 50],
                    ['name' => 'Potato', 'quantity' => 200, 'price' => 30],
                ],
            ]
        ];

        return response()->json($response);
    }

    public function manageStock(Request $request)
{
    // Log the incoming request for debugging
    \Log::info('manageStock called', $request->all());

    // Validate the request
    $validatedData = $request->validate([
        'ingredient_id' => 'required|exists:ingredients,id',
        'type' => 'required|in:in,out', // 'in' for stock in, 'out' for stock out
        'quantity' => 'required|integer|min:1', // Quantity must be positive
        'remarks' => 'nullable|string', // Remarks are optional
        'user_id' => 'nullable|exists:users,id', // User ID is optional
    ]);

    try {
        // Prepare stock data
        $stockData = [
            'ingredient_id' => $validatedData['ingredient_id'],
            'stock_in' => $validatedData['type'] === 'in' ? $validatedData['quantity'] : 0,
            'stock_out' => $validatedData['type'] === 'out' ? $validatedData['quantity'] : 0,
            'remarks' => $validatedData['remarks'] ?? null,
            'user_id' => $validatedData['user_id'] ?? null,
        ];

        // Log the stock data before creation
        \Log::info('Stock data prepared for creation:', $stockData);

        // Create the stock record
        $stock = Stock::create($stockData);
        \Log::info('Stock record created successfully', ['stock' => $stock]);

        // Update the ingredient's package weight
        $ingredient = Ingredient::findOrFail($validatedData['ingredient_id']);
        if ($validatedData['type'] === 'in') {
            $ingredient->package_weight += $validatedData['quantity'];
        } elseif ($validatedData['type'] === 'out') {
            if ($ingredient->package_weight < $validatedData['quantity']) {
                \Log::warning('Insufficient stock for transaction', [
                    'current_weight' => $ingredient->package_weight,
                    'requested_quantity' => $validatedData['quantity'],
                ]);
                return response()->json([
                    'message' => 'Insufficient stock for this transaction.',
                ], 400);
            }
            $ingredient->package_weight -= $validatedData['quantity'];
        }
        $ingredient->save();

        \Log::info('Ingredient updated successfully', ['ingredient' => $ingredient]);

        return response()->json([
            'message' => 'Stock transaction recorded and quantity updated successfully.',
            'ingredient' => $ingredient,
            'stock' => $stock,
        ], 201);
    } catch (\Exception $e) {
        \Log::error('Failed to record stock transaction', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Failed to record stock transaction.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
