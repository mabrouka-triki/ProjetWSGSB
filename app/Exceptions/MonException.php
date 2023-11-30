<?php

namespace App\Exceptions;

use Exception;

class MonException extends Exception
{
    public function __construct($message = 'Unknown exception', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return get_class($this) . "('$this->message') in {$this->getFile()} ({$this->getLine()})\n" .
            "{$this->getTraceAsString()}";
    }
}
