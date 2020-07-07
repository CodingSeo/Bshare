<?php

namespace App\Exceptions;

use Exception;

class ModuleNotSaved extends Exception
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
            'code' => 500,
            'message' => $this->message?:'module not saved',
        ];
        return response()->json($payload, 500, [], JSON_PRETTY_PRINT);
    }
}
