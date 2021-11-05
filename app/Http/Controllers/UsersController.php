<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllUsers ()
    {
        return $this->sendResponse(User::all());
    }

    public function getUser ($id)
    {
        $user = User::find($id);
        return $this->sendResponse($user, !$user ? 'Resource not found.' : '');
    }

    public function updateUser (Request $request, $id)
    {
        $user = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        if (!empty($user->password)) {
            $user->password = bcrypt($request->password);
        }
        $saved = $user->save();

        return $this->sendResponse([
            'data' => $user->toArray()
        ], $saved ? 'User record updated.' : 'Error updating record.');
    }

    public function deleteUser ($id)
    {
        $user = User::find($id);
        if (!$user) {
            $message = 'Record already deleted.';
        } else {
            $message = $user->delete() ? 'User record deleted.' : 'Error deleting record.';
        }
        return $this->sendResponse(null, $message);
    }
}
