<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        $this->renderable(function (ValidationException $e, $request) {
            return $this->errorResponse($e->errors(), $e->status);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return $this->errorResponse('The specified method for the request is invalid', 405);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return $this->errorResponse('The resources you are trying to find does not exist', 404);
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            return $this->errorResponse('Unauthenticated', 401);
        });

        $this->renderable(function (AuthorizationException $e, $request) {
            return $this->errorResponse($e->getMessage(), 403);
        });

        $this->renderable(function (HttpException $e, $request) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        });

        $this->renderable(function (QueryException $e, $request) {
            $errorCode = isset($e->errorInfo[1]) ? $e->errorInfo[1] : false;

            if($errorCode == 1451){
                return $this->errorResponse('Cannot remove this resource permanently. It is related with any other resource', 409);
            }
        });

        if(!config('app.debug')){
            $this->renderable(function (Throwable $e) {
                return $this->handleUnexpectedException($e);
            });
        }
    }

    protected function handleUnexpectedException(Throwable $e){
        return $this->errorResponse('Unexpected Exception, Try Later', 500);
    }
}

