<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return response()->json(['cod' => 'WS003', 'msg'=>trans('passwords.token.expired')], 400);
        }

        if ($exception instanceof TokenExpiredException) {
           return response()->json(['cod' => 'WS003', 'msg'=>trans('passwords.token.expired')], 401);
       }

       if ($exception instanceof JWTException) {
           return response()->json(['cod' => 'WS003', 'msg'=>trans('passwords.token.invalid')], 401);
       }

        
        return parent::render($request, $e);
    }
}
