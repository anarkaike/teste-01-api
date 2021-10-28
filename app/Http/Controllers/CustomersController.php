<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function getAllCustomers ()
    {
        return response()->json([
            'data' => Customer::all()
        ], 201);
    }

    public function createCustomer (Request $request) {
        $customer = new Customer;
        $customer->name     = $request->name;
        $customer->email    = $request->email;
        $customer->phone    = $request->phone;
        $customer->state    = $request->state;
        $customer->city     = $request->city;
        $customer->birthday = $request->birthday;
        $saved = $customer->save();

        return response()->json([
            'id' => $customer->id,
            'message' => $saved ? 'Customer resource created.' : 'Error creating resource.',
            'data' => $customer->toArray()
        ], 201);
    }

    public function getCustomer ($id)
    {
        $response = ['data' => $customer = Customer::find($id)];
        if (!$customer) $response['message'] = 'Resource not found.';
        return response()->json($response, 201);
    }

    public function updateCustomer (Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name     = $request->name;
        $customer->email    = $request->email;
        $customer->phone    = $request->phone;
        $customer->state    = $request->state;
        $customer->city     = $request->city;
        $customer->birthday = $request->birthday;

        return response()->json([
            'message' => $customer->save() ? 'Customer resource updated.' : 'Error updating resource.',
            'data' => $customer->toArray()
        ], 201);
    }

    public function deleteCustomer ($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            $message = 'Record already deleted.';
        } else {
            $message = $customer->delete() ? 'Customer resource deleted.' : 'Error deleting resource.';
        }
        return response()->json([
            'message' => $message
        ], 201);
    }
}
