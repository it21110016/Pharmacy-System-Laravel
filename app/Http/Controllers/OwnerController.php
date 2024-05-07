<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Customer;

class OwnerController extends Controller
{
    public function addItem(Request $request)
    {

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        // Insert logic here to add item to inventory
        $item = Inventory::create([
            'name' => $request->name,
            'quantity' => $request->quantity
        ]);

        return response()->json(['message' => 'Item added successfully', 'item' => $item], 201);
    }

    public function addCustomer(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|string'
        ]);

        // Insert logic here to add customer
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address
        ]);

        return response()->json(['message' => 'Customer added successfully', 'customer' => $customer], 201);
    }
}
