<?php

namespace TochkaApi;

use TochkaApi\Auth\AccessToken;
use TochkaApi\Exceptions\ModelNotFoundException;
use TochkaApi\HttpAdapters\HttpClientInterface;
use TochkaApi\Models\BaseModel;

/**
 * @method  \TochkaApi\Models\Organization organization()
 * @method  \TochkaApi\Models\Account account()
 * @method  \TochkaApi\Models\Payment payment()
 * @method  \TochkaApi\Models\Salary salary()
 * @method  \TochkaApi\Models\Statement statement()
 */

final class TochkaApi
{
    /**
     *
     */
    const HOST = "https://enter.tochka.com";

    /**
     *
     */
    const VERSION = "v1";

    /**
     * @var HttpClientInterface
     */
    protected $adapter;

    /**
     * @var
     */
    protected $client_id;

    /**
     * @var
     */
    protected $client_secret;

    /**
     * @var AccessToken
     */
    protected $access_token;

    /**
     * @var bool
     */
    protected $enableSandbox  = false;

    /**
     * TochkaApi constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param HttpClientInterface $adapter
     * @param bool $enableSandbox
     */
    public function __construct(string $client_id, string $client_secret, HttpClientInterface $adapter, bool $enableSandbox = false)
    {
        $this->setAdapter($adapter);
        $this->setClientId($client_id);
        $this->setClientSecret($client_secret);
        $this->setEnableSandbox($enableSandbox);
    }

    /**
     * @param string|AccessToken $access_token
     * @param int $expires_in
     */
    public function setAccessToken($access_token, int $expires_in = 0, string $refresh_token = "") : void {
        $this->access_token = $access_token instanceof AccessToken ? $access_token : new AccessToken($access_token, $expires_in, $refresh_token);
    }

    /**
     * @return AccessToken
     */
    public function getAccessToken() : AccessToken {
        return $this->access_token instanceof AccessToken ? $this->access_token : new AccessToken("");
    }

    /**
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->isEnableSandbox() ? static::HOST . "/sandbox/" . static::VERSION : static::HOST . "/api/" . static::VERSION;
    }

    /**
     * @return bool
     */
    protected function isEnableSandbox(): bool
    {
        return $this->enableSandbox;
    }

    /**
     * @param bool $enableSandbox
     */
    protected function setEnableSandbox(bool $enableSandbox): void
    {
        $this->enableSandbox = $enableSandbox;
    }

    /**
     * @param $instance
     * @param string ...$parameters
     * @return string
     */
    public function getEndpoint($instance, ...$parameters) : string
    {
        return trim($this->getBaseUrl() . "/" . $instance . "/" . (!empty($parameters) ? implode("/", $parameters) : ""), "/");
    }

    /**
     * @return HttpClientInterface
     */
    public function getAdapter() : HttpClientInterface
    {
        return $this->adapter;
    }

    /**
     * @param HttpClientInterface $adapter
     */
    protected function setAdapter($adapter) : void
    {
        $this->adapter = $adapter;
    }

    /**
     * @return string
     */
    protected function getClientId() : string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    protected function setClientId($client_id) : void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    protected function getClientSecret() : string
    {
        return $this->client_secret;
    }

    /**
     * @param mixed $client_secret
     */
    protected function setClientSecret($client_secret) : void
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return string
     */
    public function getAuthorizeUrl() : string {
        return $this->getEndpoint("authorize?response_type=code&client_id={$this->getClientId()}");
    }

    /**
     * @param string $code
     * @return AccessToken
     */
    public function token(string $code) : AccessToken {
        $data = [
            "code" => $code,
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "grant_type" => "authorization_code"
        ];

        return $this->requestAccessToken($data);
    }

    /**
     * @param string $refresh_token
     * @return AccessToken
     */
    public function refresh(string $refresh_token) : AccessToken {
        $data = [
            "refresh_token" => $refresh_token,
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "grant_type" => "refresh_token"
        ];

        return $this->requestAccessToken($data);
    }

    /**
     * @param array $data
     * @return AccessToken
     */
    private function requestAccessToken(array $data) : AccessToken {
        $response = $this->getAdapter()->post($this->getEndpoint("oauth2", "token"), $this->getAccessToken(), json_encode($data))->getArray();

        return new AccessToken($response["access_token"], $response["expires_in"], $response["refresh_token"]);
    }

    /**
     * @param $name
     * @param $arguments
     * @return BaseModel
     * @throws ModelNotFoundException
     */
    public function __call($name, $arguments)
    {
        $className = '\\TochkaApi\\Models\\' . ucfirst($name);

        if (!class_exists($className)) {
            throw new ModelNotFoundException($name);
        }

        $model = new $className($this);

        return $model;
    }
}