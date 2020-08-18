<?php

namespace TochkaApi\HttpAdapters;

use TochkaApi\Auth\AccessToken;
use TochkaApi\Responses\RawResponse;

/**
 * Class HttpAdapterBase
 * @package TochkaApi\HttpAdapters
 */
abstract class HttpAdapterBase
{
    /**
     * @var
     */
    protected $client;

    /**
     * HttpAdapterBase constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $url
     * @param array $data
     * @param AccessToken $access_token
     * @return RawResponse
     */
    public function get($url, $access_token, $data = []) : RawResponse
    {
        return $this->request("GET", $url, $access_token, $data);
    }

    /**
     * @param $url
     * @param array $data
     * @param AccessToken $access_token
     * @return RawResponse
     */
    public function post($url, $access_token, $data = []) : RawResponse
    {
        return $this->request("POST", $url, $access_token, $data);
    }

    /**
     * @param $method
     * @param $url
     * @param array $data
     * @param AccessToken $access_token
     * @param array $headers
     * @return RawResponse
     */
    abstract function request($method, $url, AccessToken $access_token, $data = [], $headers = []) : RawResponse;
}