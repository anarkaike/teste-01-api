<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if (!User::where('email', '=', $request->email)->exists()) {
            $this->validate($request, [
                'name' => 'required|min:4',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $token = $user->createToken('Personal Access Token')->accessToken;

            return $this->sendResponse(['id' => $user->id, 'token' => $token], 'User register successfully.');
        } else {
            return $this->sendResponse(null, 'Email ['.$request->email.'] already exists.');
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = auth()->user()->createToken('Personal Access Token')->accessToken;
            return $this->sendResponse(['token' => $token], 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * Login Unauthorised
     *
     * @return \Illuminate\Http\Response
     */
    public function unauthorised(Request $request)
    {
        return $this->sendError('Unauthorised.');
    }
}
