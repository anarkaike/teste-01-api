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
        return $this->sendResponse(Customer::all());
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

        if (is_array($request->plans)) {
            $customer->customersPlans()->sync($request->plans);
            $customer->save();
        }

        return $this->sendResponse($customer->toArray(), $saved ? 'Customer resource created.' : 'Error creating resource.');
    }

    public function getCustomer ($id)
    {
        $customer = Customer::find($id);
        $plans = $customer->plans()->get();

        $customer = $customer->toArray();
        foreach ($plans as $plan) {
            $customer['plans'][$plan->id] = $plan;
        }

        return $this->sendResponse(
            $customer,
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

        if (is_array($request->plans)) {
            $customer->customersPlans()->sync($request->plans);
            $customer->save();
        }

        $result = $customer->toArray();
        $result['plans'] = $customer->plans()->get();

        return $this->sendResponse($result, $saved ? 'Customer resource updated.' : 'Error updating resource.');
    }

    public function deleteCustomer ($id)
    {
        $customer = Customer::find($id);
        if ('sp' == $customer->state) {
            return $this->sendError('This customer cannot be deleted. Customers from "sp" cannot be excluded.');
        } elseif (!0 == $customer->plans()->where('plans.id', 1)->has('customersPlans', '>', 0)->count()) {
            return $this->sendError('This customer cannot be deleted. "Free" plan customers cannot be excluded.');
        } elseif (!$customer) {
            return $this->sendError( 'Record already deleted.');
        } else {
            return $this->sendResponse(null, $customer->delete() ? 'Customer resource deleted.' : 'Error deleting resource.');
        }
    }
}
