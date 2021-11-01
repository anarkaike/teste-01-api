<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllPlans ()
    {
        return $this->sendResponse([
            'data' => Plan::all()
        ]);
    }

    public function createPlan (Request $request) {
        $plan = new Plan;
        $plan->name     = $request->name;
        $plan->price    = $request->price;
        $saved = $plan->save();

        return $this->sendResponse([
            'id' => $plan->id,
            'data' => $plan->toArray()
        ], $saved ? 'Plan record created.' : 'Error creating record.');
    }

    public function getPlan ($id)
    {
        $response = ['data' => $plan = Plan::find($id)];
        return $this->sendResponse($response, !$plan ? 'Resource not found.' : '');
    }

    public function updatePlan (Request $request, $id)
    {
        $plan = Plan::find($id);
        $plan->name     = $request->name;
        $plan->price    = $request->price;
        $saved = $plan->save();

        return $this->sendResponse([
            'data' => $plan->toArray()
        ], $saved ? 'Plan record updated.' : 'Error updating record.');
    }

    public function deletePlan ($id)
    {
        $plan = Plan::find($id);
        if (!$plan) {
            $message = 'Record already deleted.';
        } else {
            $message = $plan->delete() ? 'Plan record deleted.' : 'Error deleting record.';
        }
        return $this->sendResponse(null, $message);
    }
}
