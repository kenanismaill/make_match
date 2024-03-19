<?php

namespace App\Exceptions\api\v1;

use Exception;

class ApiException extends Exception
{
    protected $errorCode;

    public function __construct($errorCode, $message = "", $code = 0, Exception $previous = null)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
