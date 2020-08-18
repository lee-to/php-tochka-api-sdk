<?php

namespace TochkaApi\Responses;


use TochkaApi\Exceptions\AuthorizationException;
use TochkaApi\Exceptions\RequestException;
use TochkaApi\Responses\Interfaces\ResponseInterface;

/**
 * Class RawResponse
 * @package TochkaApi\Responses
 */
class RawResponse implements ResponseInterface
{
    /**
     * @var
     */
    protected $code;
    /**
     * @var
     */
    protected $headers;
    /**
     * @var
     */
    protected $body;

    /**
     * RawResponse constructor.
     * @param $headers
     * @param $body
     * @param $code
     */
    public function __construct($headers, $body, $code)
    {
        $this->headers = $headers;

        $this->body = $body;

        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getArray() : array {
        return json_decode($this->getBody(), true);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @throws AuthorizationException
     * @throws RequestException
     */

    public function handleError()
    {
        switch ($this->getCode()) {
            case AuthorizationException::HTTP_CODE:
                throw new AuthorizationException($this->getHeaders(), $this->getBody());
                break;
            default:
                throw new RequestException($this->getBody(), $this->getCode());
        }
    }
}