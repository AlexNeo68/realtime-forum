<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            return $this->handleException($e);
        });
    }

    public function handleException(Exception $exception)
    {

     if($exception instanceof TokenInvalidException) {
        return response(['error' => 'Token is invalid'], Response::HTTP_BAD_REQUEST);
     }
     if($exception instanceof TokenBlacklistedException) {
        return response(['error' => 'Token is blacklist'], Response::HTTP_BAD_REQUEST);
     }
     if($exception instanceof JWTException) {
        return response(['error' => 'Token is not provided'], Response::HTTP_BAD_REQUEST);
     }
 }
}
