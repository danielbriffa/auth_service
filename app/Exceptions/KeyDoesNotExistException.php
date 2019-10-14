<?php

namespace App\Exceptions;

use Exception;

class KeyDoesNotExistException extends Exception
{
    public function render($request)
    {
        //Return response
        return response()->json('Key passed, does not exist', 404);
    }
}
