<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< HEAD
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Clientes;
use Validator;
use Auth;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'co_vendedor' => 'required'
=======
use App\User;
use Hash;
use JWTAuth;
use Mail;
use Validator;

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
    	


        $validator = Validator::make($request->all(), [
            'email' => 'email'
>>>>>>> 3cf521c87cec7f9e6b42671148ec1aae5f49a4bb
        ]);


        if ($validator->fails()) {
<<<<<<< HEAD
            return response()->json(['cod' => 'WS003', 'msg'=>"Error con los parametros", 'validation'=>$validator->errors()]);
        }



        return Clientes::where('co_vendedor', '=', $request->all()['co_vendedor'])->get();


    }

    public function login(Request $request)
    {        
    	 $input = $request->all();

        if (Auth::attempt($input)) {
            return "login";
        }

        return "usuario no existe";
    }
    public function logout(Request $request)
    {        
    	Auth::logout();

        return "Cierra sesion";
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'co_vendedor' => 'required',
            'co_sucursal' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['cod' => 'WS003', 'msg'=>"Error con los parametros", 'validation'=>$validator->errors()]);
        }

        $user = Clientes::create([
				'co_cli'	=> 2,
				'co_vendedor'	=> $request->co_vendedor,
        ]);

        return Clientes::where('co_vendedor', '=', $request->all()['co_vendedor'])->get();
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Clientes::find($id);

        if(!$user){
            return response()->json(['cod' => 'WS002', 'msg'=>"Usuario no encontrado"]);
        }



        $user->save();
        return response()->json(['cod' => 'WS001', 'msg'=>"Usuario Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Clientes::find($id);

        $user->delete();
=======
            return response()->json(['cod' => 'WS003', 'msg'=>trans('passwords.email'), 'validation'=>$validator->errors()]);
        }


        try{

            $input = $request->all();

            $user = User::where('email','=',$input['email'])->get()->first();
            $user->security_code = $this->getRandomCode();
            $user->save();

            $data = array(
                'codigo' => $user->security_code,
                'email' => $user->email,
                'nombre' => $user->nombre.' '.$user->apellido
            );

            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['cod' => 'WS002', 'msg'=>trans('passwords.token')]);
            }

            Mail::send('welcome', $data, function($msj) use ($data){
                $msj->subject(trans('passwords.code'));
                $msj->to($data['email']);
            });
            return response()->json(['cod' => 'WS001', 'msg'=>trans('passwords.sent'), 'data' => ['token' => $token]]);

        }catch(\Exception $e){
            return response()->json(['cod' => 'WS003', 'msg'=>trans('passwords.user')]);
        }
    }
    
    public function set_new_password(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'token'    => 'required',
            'codigo'   => 'required',
        ],[
            'required' => 'El campo :attribute es requerido.',
        ]);

        if ($validator->fails()) {
            return response()->json(['cod' => 'WS003', 'msg'=>trans('passwords.email'), 'validation'=>$validator->errors()]);
        }


        $input = $request->all();
    	$user = JWTAuth::toUser($input['token']);

        if($user->security_code != $input['codigo'])
            return response()->json(['cod' => 'WS002', 'msg'=>trans('passwords.codefailed')]);

        $user = User::find($user->id);
        $user->password = Hash::make($input['password']);
        $user->security_code = null;
        $user->save();

        return response()->json(['cod' => 'WS001', 'msg'=>trans('passwords.reset')]);

>>>>>>> 3cf521c87cec7f9e6b42671148ec1aae5f49a4bb
    }
}
