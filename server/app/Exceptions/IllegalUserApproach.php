<?php

namespace App\Exceptions;

use Exception;

class IllegalUserApproach extends Exception
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
        $code = 403;
        $payload = [
            'code' => $code ,
            'message' => $this->message ?:'IllegalUserApproach',
        ];
        return response()->json($payload, $code , [], JSON_PRETTY_PRINT);
    }
}
