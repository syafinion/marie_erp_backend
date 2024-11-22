<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}

