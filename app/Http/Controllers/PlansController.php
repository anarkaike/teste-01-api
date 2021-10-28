<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function getAllPlans ()
    {
        return response()->json([
            'data' => Plan::all()
        ], 201);
    }

    public function createPlan (Request $request) {
        $plan = new Plan;
        $plan->name     = $request->name;
        $plan->price    = $request->price;
        $saved = $plan->save();

        return response()->json([
            'id' => $plan->id,
            'message' => $saved ? 'Plan record created.' : 'Error creating record.',
            'data' => $plan->toArray()
        ], 201);
    }

    public function getPlan ($id)
    {
        $response = ['data' => $plan = Plan::find($id)];
        if (!$plan) $response['message'] = 'Resource not found.';
        return response()->json($response, 201);
    }

    public function updatePlan (Request $request, $id)
    {
        $plan = Plan::find($id);
        $plan->name     = $request->name;
        $plan->price    = $request->price;

        return response()->json([
            'message' => $plan->save() ? 'Plan record updated.' : 'Error updating record.',
            'data' => $plan->toArray()
        ], 201);
    }

    public function deletePlan ($id)
    {
        $plan = Plan::find($id);
        if (!$plan) {
            $message = 'Record already deleted.';
        } else {
            $message = $plan->delete() ? 'Plan record deleted.' : 'Error deleting record.';
        }
        return response()->json([
            'message' => $message
        ], 201);
    }
}
