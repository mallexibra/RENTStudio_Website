<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();

            for ($i = 0; $i < $users->count(); $i++) {
                if ($users[$i]['profile'] != null) {
                    $users[$i]['profile'] = url('/profiles/' . $users[$i]['profile']);
                }
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data users successfully",
                "data" => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "error_message" => $e->getMessage()
            ]);
        }
    }

    public function show(String $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user['profile'] != null) {
                $user['profile'] = url('/profiles/' . $user['profile']);
            }

            return response()->json([
                "status" => false,
                "message" => "GET data user by id successfully",
                "data" => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "error_message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required",
                "profile" => "nullable|image|mimes:jpeg,jpg,png"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error_message" => $validator->errors()->all()
                ]);
            }

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/profiles'), $fileName);
            }

            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "profile" => $fileName
            ]);

            return response()->json([
                "status" => true,
                "message" => "REGISTER data user successfully",
                "data" => [
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "profile" => $fileName ? url('/profiles/' . $fileName) : null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "error_message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $user = User::findOrFail($id);

            $name = $user->name;
            if ($request->name) {
                $name = $request->name;
            }

            $password = $user->password;
            if ($request->password) {
                $password = Hash::make($request->password);
            }

            $email = $user->email;
            if ($request->email) {
                $email = $request->email;
            }

            $profile = $user->profile;
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                unlink(public_path('/profiles/' . $profile));
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/profiles'), $fileName);
                $profile = $fileName;
            }

            $user->update([
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "profile" => $profile
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data user by id successfully",
                "data_edited" => [
                    "name" => $name,
                    "email" => $email,
                    "profile" => url('/profiles/' . $profile)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "error_message" => $e->getMessage()
            ]);
        }
    }

    public function destroy(String $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->profile) {
                unlink(public_path('/profiles/' . $user->profile));
            }

            $user->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data user by id successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "error_message" => $e->getMessage()
            ]);
        }
    }
}
