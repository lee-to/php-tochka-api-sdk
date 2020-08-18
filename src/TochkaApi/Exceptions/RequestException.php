<?php

namespace TochkaApi\Exceptions;


class RequestException extends \Exception
{

    public function __construct($message = "", $code = 0) {
        $errorData = json_decode($message, true);

        if(isset($errorData["message"])) {
            $this->message .= $errorData['message'] . '. ';
        }
    }
}