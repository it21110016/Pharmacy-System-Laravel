<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class ManagerController extends Controller
{
    public function updateCustomer(Request $request, $id)
    {
        // // Validation for manager access
        // if ($request->user()->role !== 'manager') {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,'.$id,
            'address' => 'required|string'
        ]);

        // Insert logic here to update customer details
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();

        return response()->json(['message' => 'Customer updated successfully', 'customer' => $customer], 200);
    }

    public function deleteCustomer($id)
    {
        // // Validation for manager access
        // if ($request->user()->role !== 'manager') {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        // Insert logic here to delete customer
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
