<?php

namespace TochkaApi\HttpAdapters;


use TochkaApi\Auth\AccessToken;
use TochkaApi\Responses\RawResponse;

/**
 * Interface HttpClientInterface
 * @package TochkaApi\HttpAdapters
 */
interface HttpClientInterface
{
    /**
     * @param $url
     * @param AccessToken $access_token
     * @param array $data
     * @return RawResponse
     */
    public function get($url, $access_token, $data = []) : RawResponse;

    /**
     * @param $url
     * @param AccessToken $access_token
     * @param array $data
     * @return RawResponse
     */
    public function post($url, $access_token, $data = []) : RawResponse;


    /**
     * @param $method
     * @param $url
     * @param array $data
     * @param AccessToken $access_token
     * @param array $headers
     * @return RawResponse
     */
    public function request($method, $url, AccessToken $access_token, $data = [], $headers = []) : RawResponse;
}