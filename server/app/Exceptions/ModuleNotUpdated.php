<?php

namespace App\Exceptions;

use Exception;

class ModuleNotUpdated extends Exception
{
    protected $message;
    public function __construct(string $message = null)
    {
        $this->message = $message;
    }
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $payload = [
            'code' => 404,
            'message' => $this->message?:'module not found',
        ];
        return response()->json($payload, 404, [], JSON_PRETTY_PRINT);
    }
}
