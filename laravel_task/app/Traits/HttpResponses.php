<?php

namespace App\Traits;

trait HttpResponses {


    /**
     * use it when the response to the request is a success 
     * @param $data  
     * @param string $message
     * @param int $code
     */
    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Request was successful.',
            'message' => $message,
            'data' => $data,
        ], $code);
    }


    /**
     * use it when the response to the request is a fail
     * @param $data  
     * @param string $message
     * @param int $code
     */

    protected function error(string $message = null, int $code)
    {
        return response()->json([
            'status' => 'An error has occurred...',
            'message' => $message,
        ], $code);
    }
}
