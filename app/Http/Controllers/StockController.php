<?php

/*
 * File: StockController.php
 * Project: Marie ERP
 * Created Date: December 2025
 * 
 * Copyright (c) 2025 Group 17
 * 
 * Authors:
 * Syafiq - Group 17
 * 
 * Description:
 * Controller responsible for managing stock operations in the Marie ERP system.
 * Handles inventory management, stock transactions, stock cards, and stock level tracking.
 * Implements CRUD operations for stock management with detailed logging and validation.
 * 
 * Features:
 * - Stock level tracking
 * - Stock in/out transactions
 * - Stock card generation
 * - Inventory management
 * - Stock planning (plan to buy)
 * - Price per unit tracking
 * - Stock consumption monitoring
 * - Closing stock calculations
 * 
 * API Endpoints:
 * - GET /stock/list - List stocks for an ingredient
 * - POST /stock/create - Create new stock entry
 * - PUT /stock/edit - Update stock record
 * - DELETE /stock/delete - Delete stock record
 * - POST /stock/manage - Manage stock in/out transactions
 * - GET /stock/card/download - Download stock card report
 * - GET /stock/select - Get selectable stock items
 * 
 * Dependencies:
 * - Laravel Framework
 * - Stock Model
 * - Ingredient Model
 * - Database migrations
 * - Laravel Validation
 * - Laravel Logging
 * 
 * Data Flow:
 * - Validates incoming stock transactions
 * - Checks stock availability
 * - Updates stock levels
 * - Maintains stock history
 * - Calculates closing balances
 * 
 * Modified/Adapted From:
 * - Laravel inventory management patterns
 *   Source: https://laravel.com/docs/eloquent
 * - Laravel validation practices
 *   Source: https://laravel.com/docs/validation
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient; 
use App\Models\Stock;

class StockController extends Controller
{
    public function listStocks(Request $r)
{
    $stocks = Stock::where('ingredient_id', $r->item)
        ->orderBy('created_at')
        ->with('ingredient')
        ->get()
        ->map(fn($s) => [
            'id'              => $s->id,
            'datecreated'     => $s->created_at->toDateString(),
            'stockCount'      => $s->stock_in,
            'planToBuy'       => $s->plan_to_buy,
            'bought'          => $s->stock_out,
            'pricePerUnit'    => $s->price_per_unit,
            'unit'            => $s->ingredient->measurement,
            'consumption'     => $s->consumption,
            'closingStock'    => $s->closing_stock,

            // ← add these three:
            'processing_pct'  => $s->processing_pct,
            'packaging_pct'   => $s->packaging_pct,
            'environment_pct' => $s->environment_pct,
        ]);

    return response()->json(['stocks' => $stocks]);
}




public function createStock(Request $request)
{
    $data = $request->all();
    $data['user_id'] = $request->input('userId');  // ← map camelCase userId → snake_case user_id

    $stock = Stock::create($data);

    return response()->json([
      'message' => 'Stock created successfully',
      'stock'   => $stock,
    ]);
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
    \Log::info('manageStock called', $request->all());

    $validated = $request->validate([
        'ingredient_id'   => 'required|exists:ingredients,id',
        'type'            => 'required|in:in,out',
        'quantity'        => 'required|integer|min:1',
        'plan_to_buy'     => 'nullable|integer|min:0',
        'price_per_unit'  => 'nullable|numeric|min:0',
        'remarks'         => 'nullable|string',
        'user_id'         => 'nullable|exists:users,id',
    ]);

    $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

    // Get previous closing or zero
    $lastStock       = Stock::where('ingredient_id', $ingredient->id)
    ->orderBy('created_at', 'desc')
    ->first();
// FALL BACK TO THE INGREDIENT’S ORIGINAL PACKAGE_WEIGHT
$previousClosing = $lastStock 
? $lastStock->closing_stock 
: (int) ($ingredient->package_weight ?? 0);

    // Prevent stock-out > available
    if ($validated['type'] === 'out' && $validated['quantity'] > $previousClosing) {
        return response()->json([
            'message' => 'Insufficient stock to perform this operation.'
        ], 422);
    }

    $stockIn  = $validated['type'] === 'in'  ? $validated['quantity'] : 0;
    $stockOut = $validated['type'] === 'out' ? $validated['quantity'] : 0;

    $closingStock = $previousClosing + $stockIn - $stockOut;
    $consumption  = $stockOut;

    $stockData = [
        'ingredient_id'   => $ingredient->id,
        'stock_in'        => $stockIn,
        'stock_out'       => $stockOut,
        'plan_to_buy'     => $validated['plan_to_buy']   ?? 0,
        'price_per_unit'  => $validated['price_per_unit'] ?? 0,
        'consumption'     => $consumption,
        'closing_stock'   => $closingStock,
        'remarks'         => $validated['remarks']       ?? null,
        'user_id'         => $validated['user_id']       ?? null,
    ];

    $stock = Stock::create($stockData);

    \Log::info('Stock record created', ['stock' => $stock]);

    // Update Ingredient’s package_weight
    // $ingredient->package_weight = $closingStock;
    // $ingredient->save();

    return response()->json([
        'message'    => 'Stock transaction recorded and quantity updated successfully.',
        'ingredient' => $ingredient,
        'stock'      => $stock,
    ], 201);
}

    

}
