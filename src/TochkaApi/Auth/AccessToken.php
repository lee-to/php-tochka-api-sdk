<?php

namespace TochkaApi\Auth;


/**
 * Class AccessToken
 * @package TochkaApi\Auth
 */
class AccessToken
{
    /**
     * @var
     */
    protected $access_token;

    /**
     * @var
     */
    protected $refresh_token;

    /**
     * @var
     */
    protected $expires_in;

    /**
     * AccessToken constructor.
     * @param string $access_token
     * @param int $expires_in
     * @param string $refresh_token
     */
    public function __construct(string $access_token, int $expires_in = 7200, string $refresh_token = "")
    {
        $this->setAccessToken($access_token);
        $this->setExpiresIn($expires_in);
        $this->setRefreshToken($refresh_token);
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }


    /**
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresIn() : \DateTime
    {
        return $this->expires_in;
    }


    /**
     * @param int $expires_in
     */
    public function setExpiresIn(int $expires_in): void
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp(time() + $expires_in);

        $this->expires_in = $dateTime;
    }

    /**
     * @return bool|null
     */
    public function isExpired()
    {
        if ($this->getExpiresIn() instanceof \DateTime) {
            return $this->getExpiresIn()->getTimestamp() < time();
        }

        return null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getAccessToken();
    }
}