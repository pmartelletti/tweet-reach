<?php

namespace App\Exceptions;

class TweetInvalidUrlException extends \Exception
{
    public function __construct($url)
    {
        $message = sprintf("'%s' is not a valid Tweet URL", $url);
        parent::__construct($message, 0, null);
    }
}
