<?php

namespace TochkaApi\Auth;


/**
 * Class BearerAuth
 * @package TochkaApi\Auth
 */
class BearerAuth implements AuthInterface
{
    /**
     * @var
     */
    private $token;

    /**
     * BearerAuth constructor.
     * @param AccessToken $token
     */
    public function __construct(AccessToken $token)
    {
        $this->setToken($token);
    }

    /**
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * @param AccessToken $token
     */
    private function setToken(AccessToken $token): void
    {
        $this->token = $token->getAccessToken();
    }


    /**
     * @return array
     */
    public function getHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        if($this->getToken() != "") {
            $headers['Authorization'] = "Bearer {$this->getToken()}";
        }

        return $headers;
    }
}