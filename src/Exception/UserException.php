<?php


namespace App\Exception;


use Throwable;

class UserException extends \Exception
{
    public function __construct($message = 'Failed to create user.', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
