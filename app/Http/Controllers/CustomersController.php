<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllCustomers ()
    {
        return $this->sendResponse([
            'data' => Customer::all()
        ]);
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

        return $this->sendResponse([
            'id' => $customer->id,
            'data' => $customer->toArray()
        ], $saved ? 'Customer resource created.' : 'Error creating resource.');
    }

    public function getCustomer ($id)
    {
        $customer = Customer::find($id);
        return $this->sendResponse(
            ['data' => $customer],
            !$customer ? 'Resource not found.' : 'Found resource.'
        );
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
        $saved = $customer->save();

        return $this->sendResponse([
            'data' => $customer->toArray()
        ], $saved ? 'Customer resource updated.' : 'Error updating resource.');
    }

    public function deleteCustomer ($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            $message = 'Record already deleted.';
        } else {
            $message = $customer->delete() ? 'Customer resource deleted.' : 'Error deleting resource.';
        }

        return $this->sendResponse(null, $message);
    }
}
