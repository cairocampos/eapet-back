<?php

namespace App\Exceptions;

use App\Services\Providers\HttpStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $statusCodes = [HttpStatus::HTTP_INTERNAL_SERVER_ERROR, HttpStatus::HTTP_NOT_FOUND];
        $messages = [
            500 => 'Algo inesperado aconteceu.',
            404 => 'Registro não encontado.'
        ];

        if($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => $messages[HttpStatus::HTTP_NOT_FOUND]
            ], HttpStatus::HTTP_NOT_FOUND);
        }

        if($request->expectsJson() && method_exists($exception, 'getCode') && in_array($exception->getCode(), $statusCodes)) {            
            if(in_array($exception->getCode(), array_keys($messages))) {
                return response()->json([
                    'message' => $messages[$exception->getCode()]
                ], $exception->getCode());
            }
        }

        return parent::render($request, $exception);
    }
}
