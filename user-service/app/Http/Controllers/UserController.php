<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_registration(Request $request)
    {
        $request->validate([
            'loginid' => 'required|unique:users',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:profiles',
            'phone' => 'nullable',
            'present_address' => 'required',
            'shipping_address' => 'required',
        ]);

        $user = new \App\Models\User();
        $user->loginid = $request->loginid;
        $user->password = $request->password;
        
        if($user->save()){
            $profile = new \App\Models\Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $request->firstname;
            $profile->last_name = $request->lastname;
            $profile->date_of_birth = $request->date_of_birth;
            $profile->email = $request->email;
            $profile->phone = $request->phone;
            $profile->present_address = $request->present_address;
            $profile->shipping_address = $request->shipping_address;

            $profile->role_id = 2;
            $profile->save();
        }

        return response()->json(['message' => 'User registered successfully'], 201);

    }

    public function getUserById($id)
    {
        $user = \App\Models\User::with('profile')->find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
}
