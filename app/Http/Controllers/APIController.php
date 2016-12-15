<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Clientes;
use Validator;
use Auth;
use DB;

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

        $data = DB::table('clientes')->where('co_vendedor', '=', $request->co_vendedor)->get();


        return response()->json(['cod' => 'WS001', 'msg'=>"Clientes listados", 'data' => $data, 'validation'=>$validator->errors()]);

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

         //Se obtiene el usuario
        $userAuth = Auth::user();

        $validateRule = [
            'token'         => 'required',
            'co_vendedor'   => 'required',
            'co_sucursal'   => 'required',
            'co_segmento'   => 'required',
            'tipo'          => 'required',
            'activo'        => 'required',
            'email'         => 'required | email',
            'descripcion'   => 'required',
            'direccion'     => 'required',
            'direc_entre'   => 'required',
            'telefono'      => 'required | integer',
            'cod_zona'      => 'required ',
            'rif'           => 'regex:(^[JGVEP][0-9]{5,10})',
        ];

        //Se verifica que los parametros sean los correctos
        $compareParameter = count(array_diff_key($request->all(), $validateRule));
        // Validando con los requeridos y formatos
        $validator = Validator::make($request->all(), $validateRule);

        if(!$compareParameter){
            if ($validator->fails())
                return response()->json(['cod' => 'WS003', 'msg'=>"Error con los parametros", 'validation'=>$validator->errors()]);
            
            $user = Clientes::create([
				'co_vendedor'	=> $request->co_vendedor,
                'co_zona' => $request->co_zona,
                'rif' => $request->rif,
                'co_segmento' => $request->co_segmento,
                'tipo' => $request->tipo,
                'activo' => $request->activo,
                'email' => $request->email,
                'descripcion' => $request->descripcion,
                'direccion' => $request->direccion,
                'direc_entre' => $request->direc_entre,
                'telefono' => $request->telefono,
                'created_user' => $userAuth->co_vendedor
                
            ]);

            if($user)
                return response()->json(['cod' => 'WS001', 'msg'=>"Cliente creado", 'validation'=>$validator->errors()]);
            else
                return response()->json(['cod' => 'WS002', 'msg'=>"Error al crear el cliente", 'validation'=>$validator->errors()]);
        }else
            return response()->json(['cod' => 'WS002', 'msg'=>"Error con cantidad de parametros", 'validation'=>$validator->errors()]);

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
         //Se obtiene el usuario
        $userAuth = Auth::user();

        $validateRule = [
            'token'         => 'required',
            'co_vendedor'   => 'required',
            'co_sucursal'   => 'required',
            'co_segmento'   => 'required',
            'tipo'          => 'required',
            'activo'        => 'required',
            'email'         => 'required | email',
            'descripcion'   => 'required',
            'direccion'     => 'required',
            'direc_entre'   => 'required',
            'telefono'      => 'required | integer'
        ];
        
        //Se verifica que los parametros sean los correctos
        $compareParameter = count(array_diff_key($request->all(), $validateRule));
        // Validando con los requeridos y formatos
        $validator = Validator::make($request->all(), $validateRule);
       
        if(!$compareParameter){
            
            if ($validator->fails())
                return response()->json(['cod' => 'V002', 'msg'=>"Error con los parametros", 'validation'=>$validator->errors()]);
            
            try{
                $user = DB::table('clientes')->where('id', '=', $id)->first();
            
                if(!$user)
                    return response()->json(['cod' => 'WS002', 'subCod' => 403, 'msg'=>"Usuario no encontrado",'data'=>null, 'validation'=> ['cod' => 'V001', 'subcod' => 200, "msg" => 'Validaciones correctas', "erros"=>$validator->errors()]]);
            
                $user->co_vendedor = $request->co_vendedor;
                $user->co_zona = $request->co_zona;
                $user->co_segmento = $request->co_segmento;
                $user->tipo = $request->tipo;
                $user->activo = $request->activo;
                $user->email = $request->email;
                $user->descripcion = $request->descripcion;
                $user->direccion = $request->direccion;
                $user->direc_entre = $request->direc_entre;
                $user->telefono = $request->telefono;
                $user->updated_user = $userAuth->co_vendedor;

                //Se graba el cliente.
                DB::table('clientes')->where('id', '=', $id)->update(get_object_vars($user));

                return response()->json(['cod' => 'WS001', 'subCod' => 200, 'msg'=>"Cliente actualizado",'data'=>null, 'validation'=> ['cod' => 'V001', 'subcod' => 200, "msg" => 'Validaciones correctas', "erros"=>$validator->errors()]]);
            }catch(\Exception $e){
                return response()->json(['cod' => 'WS003', 'subCod' => 500, 'msg'=>"Error Inesperado",'data'=>null, 'validation'=> ['cod' => 'V001', 'subcod' => 200, "msg" => 'Validaciones correctas', "erros"=>$validator->errors()]]);
            }
        }else
            return response()->json(['cod' => 'WS002', 'msg'=>"Error con la cantidad de parametros", 'validation'=>$validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        
        $validateRule = ['token' => 'required'];
        //Se verifica que los parametros sean los correctos
        $compareParameter = count(array_diff_key($request->all(), $validateRule));
        // Validando con los requeridos y formatos
        $validator = Validator::make($request->all(), $validateRule);

        if(!$compareParameter){
            if ($validator->fails())
                return response()->json(['cod' => 'WS003', 'msg'=>"Error con los parametros", 'validation'=>$validator->errors()]);

            try{
                $user = DB::table('clientes')->where('id', '=', $id)->first();
                if($user){
                    $user->activo = false; // Se cambia el estatus a 0 de inactivo
                    DB::table('clientes')->where('id', '=', $id)->update(get_object_vars($user));
                    // DB::table('clientes')->where('id', '=', $id)->delete();
                    return response()->json(['cod' => 'WS001', 'msg'=>"Cliente Desactivado"]);
                }else{
                    return response()->json(['cod' => 'WS002', 'msg'=>"Cliente no encontrado"]);
                }
            }catch(\Exception $e){
                return response()->json(['cod' => 'WS002', 'msg'=>"No se puede actualizar el cliente"]);
            }
        }else
            return response()->json(['cod' => 'WS002', 'msg'=>"Error con la cantidad de parametros", 'validation'=>$validator->errors()]);

        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ]);


        
        


    }
}
