<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class CashierController extends Controller
{
    public function removeItem($id)
    {
        // // Validation for cashier access
        // if ($request->user()->role !== 'cashier') {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        // Insert logic here to delete item
        $item = Inventory::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item removed successfully'], 200);
    }

    public function editItem(Request $request, $id)
    {
        // // Validation for cashier access
        // if ($request->user()->role !== 'cashier') {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

       // Validate incoming request data
       $request->validate([
        'name' => 'required|string',
        'quantity' => 'required|integer'
    ]);

    // Insert logic here to update item details
    $item = Inventory::findOrFail($id);
    $item->name = $request->name;
    $item->quantity = $request->quantity;
    $item->save();

    return response()->json(['message' => 'Item edited successfully', 'item' => $item], 200);
    }
}