<?php

namespace TochkaApi\HttpAdapters;


use TochkaApi\Auth\AccessToken;
use TochkaApi\Auth\BearerAuth;
use TochkaApi\Responses\RawResponse;

/**
 * Class CurlHttpClient
 * @package TochkaApi\HttpAdapters
 */
class CurlHttpClient extends HttpAdapterBase implements HttpClientInterface
{
    /**
     * @var
     */
    protected $client;

    /**
     * @var array
     */
    protected $cookies = [];

    /**
     * @param $method
     * @param $url
     * @param AccessToken $access_token
     * @param array $data
     * @param array $headers
     * @return RawResponse
     * @throws \TochkaApi\Exceptions\AuthorizationException
     * @throws \TochkaApi\Exceptions\RequestException
     */
    public function request($method, $url, AccessToken $access_token, $data = [], $headers = []) : RawResponse {
        $this->client = curl_init();

        $headers = new BearerAuth($access_token);

        curl_setopt($this->client, CURLOPT_URL, $url);

        curl_setopt($this->client, CURLOPT_HTTPHEADER, $this->compileRequestHeaders($headers->getHeaders()));

        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($this->client, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($this->client, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_setopt( $this->client, CURLOPT_HEADER, TRUE);

        if(!empty($data)) {
            curl_setopt($this->client, CURLOPT_POST, TRUE);
            curl_setopt($this->client,CURLOPT_POSTFIELDS, json_encode($data));

            if(is_array($data)) {
                curl_setopt($this->client, CURLOPT_URL, ($url . "?" . http_build_query($data)));
            }
        }

        $returnData = curl_exec($this->client);

        $headerSize = curl_getinfo($this->client, CURLINFO_HEADER_SIZE);
        $header = substr($returnData, 0, $headerSize);

        $body = substr($returnData, $headerSize);

        $this->getCookies($header);

        $response = new RawResponse([], $body, curl_getinfo($this->client, CURLINFO_HTTP_CODE));

        if ($response->getCode() != 200) {
            $response->handleError();
        }

        curl_close($this->client);

        return $response;
    }

    /**
     * @param $header
     */
    private function getCookies($header) {
        if(preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches)) {
            foreach($matches[1] as $item) {
                parse_str($item, $cookie);

                $this->cookies = array_merge($this->cookies, $cookie);
            }
        }
    }

    /**
     * @param array $headers
     * @return array
     */
    public function compileRequestHeaders(array $headers)
    {
        $return = [];

        foreach ($headers as $key => $value) {
            $return[] = $key . ': ' . $value;
        }

        return $return;
    }
}