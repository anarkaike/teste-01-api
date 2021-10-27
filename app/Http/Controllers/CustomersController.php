<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function getAllCustomers ()
    {
        // logic to get all students goes here
    }

    public function createCustomer (Request $request) {
        $customer = new Customer;
        $customer->name = 'Junio de Almeida.';//$request->name;
        $customer->email = 'anarkaike@gmail.com';//$request->course;
        $customer->phone = '5511959195007';//$request->course;
        $customer->state = 'São Paulo';//$request->course;
        $customer->city = 'São Paulo';//$request->course;
        $customer->birthday = '1990-11-10';//$request->course;
        $customer->save();

        return response()->json([
            "message" => "Customer record created."
        ], 201);
    }

    public function getCustomer ($id)
    {
        // logic to get a student record goes here
    }

    public function updateCustomer (Request $request, $id)
    {
        // logic to update a student record goes here
    }

    public function deleteCustomer ($id)
    {
        // logic to delete a student record goes here
    }
}
