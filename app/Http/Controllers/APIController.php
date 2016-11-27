<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Hash;
use JWTAuth;

use Mail;

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


    private function getRandomCode(){
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-)(.:,;";
        $su = strlen($an) - 1;
        return substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1);
    }
    
    public function repassword(Request $request)
    {
    	$input = $request->all();
        
        $user = User::where('email','=',$input['email'])->get()->first();
        $user->security_code = $this->getRandomCode();
        $user->save();

        $data = array(
            'codigo' => $user->security_code
        );

    	if (!$token = JWTAuth::fromUser($user)) {
            return response()->json(['result' => 'wrong email or password.']);
        }

        Mail::send('welcome', $data, function($msj){
            $msj->subject("Restaurar Contraseña");
            $msj->to("luis92pe@gmail.com");
        });

        return response()->json(['token' => $token]);
    }
    
    public function set_new_password(Request $request)
    {
    	$input = $request->all();
    	$user = JWTAuth::toUser($input['token']);
    	
        if($user->security_code != $input['codigo'])
            return response()->json(['result' => 'codigo malo']);

        $user = User::find($user->id);
        $user->password = Hash::make($input['password']);
        $user->security_code = null;
        $user->save();

       
        return response()->json(['result' => $user]);

    }
}
