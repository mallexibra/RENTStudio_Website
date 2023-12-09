<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validatorUser = Validator::make($request->all(), [
                "email" => "required",
                "password" => "required"
            ]);

            if ($validatorUser->fails()) {
                return response()->json([
                    "status" => false,
                    "messages" => $validatorUser->errors()
                ]);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    "message" => "Email & Password does not match with our record"
                ]);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                "status" => true,
                "message" => "User login successfully",
                "token" => $user->createToken("API TOKEN")->plainTextToken,
                "data" => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "status" => true,
            "message" => "User logout successfully"
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            "status" => true,
            "user" => Auth::user()
        ]);
    }
}
