<?php

namespace TochkaApi\Exceptions;


class AuthorizationException extends ApiException
{
    const HTTP_CODE = 403;

    /**
     * AuthorizationException constructor.
     * @param array $responseHeaders
     * @param null $responseBody
     */
    public function __construct($responseHeaders = [], $responseBody = null)
    {
        $this->parseResponseBody($responseBody);

        parent::__construct(trim($this->message), self::HTTP_CODE, $responseHeaders, $responseBody);
    }
}