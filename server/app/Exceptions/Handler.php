<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        $code = $e->getCode();
        switch ($e) {
            case $e instanceof MethodNotFoundException:
                $message = $e->getMessage() ?: 'not_found';
                break;
            case $e instanceof MethodNotAllowedException:
                $message = $e->getMessage() ?: 'not_allowed';
                break;
            case $e instanceof Exception:
                $message = $e->getMessage() ?: 'Something broken :(';
                break;
        }
        return response()->json([
            'code' => $code ?: 400,
            'errors' => $message,
        ], $code ?: 400);

        return parent::render($request, $e);
    }
}
