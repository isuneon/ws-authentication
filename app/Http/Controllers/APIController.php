<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Hash;
use JWTAuth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    // public function repassword(Request $request)
    // {        
    // 	$input = $request->only('email');
    // 	$input['password'] = Hash::make($input['password']);
    // 	User::create($input);
    //     return response()->json(['result'=>true]);
    // }
    
    public function repassword(Request $request)
    {
    	$input = $request->all();
        
        $user = User::where('email','=',$input['email'])->get()->first();

        

    	if (!$token = JWTAuth::fromUser($user)) {
            return response()->json(['result' => 'wrong email or password.']);
        }
        	return response()->json(['token' => $token]);
    }
    
    public function set_new_password(Request $request)
    {
    	$input = $request->all();
    	$user = JWTAuth::toUser($input['token']);


        $user = User::find($user->id);
        $user->password = Hash::make($input['password']);
        $user->save();

    // 	User::create($input);

        return response()->json(['result' => $user]);
    }
}
