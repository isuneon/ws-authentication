<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

        ]);


        if ($validator->fails()) {

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

    }
}
