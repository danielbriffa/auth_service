<?php

namespace App\Exceptions;

use Exception;
use Log;

class UserDataObjectNotFoundException extends Exception
{
    public function render($request)
    {
        //Return response
        return response()->json('User Data object not found', 404);
    }
}
