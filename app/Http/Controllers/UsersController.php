<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getAllUsers ()
    {
        return response()->json([
            'data' => User::all()
        ], 201);
    }

    public function createUser (Request $request) {
        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;
        $saved = $user->save();

        return response()->json([
            'id' => $user->id,
            'message' => $saved ? 'User record created.' : 'Error creating record.',
            'data' => $user->toArray()
        ], 201);
    }

    public function getUser ($id)
    {
        $response = ['data' => $user = User::find($id)];
        if (!$user) $response['message'] = 'Resource not found.';
        return response()->json($response, 201);
    }

    public function updateUser (Request $request, $id)
    {
        $user = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;

        return response()->json([
            'message' => $user->save() ? 'User record updated.' : 'Error updating record.',
            'data' => $user->toArray()
        ], 201);
    }

    public function deleteUser ($id)
    {
        $user = User::find($id);
        if (!$user) {
            $message = 'Record already deleted.';
        } else {
            $message = $user->delete() ? 'User record deleted.' : 'Error deleting record.';
        }
        return response()->json([
            'message' => $message
        ], 201);
    }
}
