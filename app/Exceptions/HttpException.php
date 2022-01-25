<?php

namespace App\Exceptions;

use Exception;

class HttpException extends Exception
{
    public function render()
    {
       return response()->json([
           'message' => $this->getMessage()
       ], $this->code);
    }
}