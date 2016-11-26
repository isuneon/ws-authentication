<?php

namespace App\Http\Middleware;

use Closure;

use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class authJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::toUser($request->input('token'));
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['cod' => 'WS003'  , 'msg'=>'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['cod' => 'WS002'  , 'msg'=>'Token is Expired']);
            }else{
                return response()->json(['cod' => 'WS004'  , 'msg'=>'Something is wrong']);
            }

        }
        return $next($request);
    }
}
