<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Hash;
use JWTAuth;

class APIController extends Controller
{
    public function register(Request $request)
    {        
    	$input = $request->all();
    	$input['password'] = Hash::make($input['password']);
    	User::create($input);
        return response()->json(['result'=>true]);
    }
    
    public function login(Request $request)
    {
    	$input = $request->all();
    	if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['cod' => 'V002'  , 'msg'=>'Email o Clave es incorrecto.']);
        }
        $user = JWTAuth::toUser($token);
        return response()->json(['cod' => 'WS001', 'msg'=>'Autenticado.', 'data' => ['token' => $token, 'user' => $user]]);
    }
    
    // public function get_user_details(Request $request)
    // {
    // 	$input = $request->all();
    // 	$user = JWTAuth::toUser($input['token']);
    //     return response()->json(['cod' => 'WS001', 'data' => ['token' => $token, 'userdata' => $user]]);
    // }
}
