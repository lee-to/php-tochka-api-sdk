<?php

namespace TochkaApi\Models;

use TochkaApi\Exceptions\EntityNotFoundException;
use TochkaApi\Exceptions\TochkaApiClientException;
use TochkaApi\Models\Traits\DefaultModel;
use TochkaApi\TochkaApi;
use TochkaApi\Resources\ResourceFactory;
use TochkaApi\Responses\Interfaces\ResponseInterface;

/**
 * Class BaseModel
 * @package TochkaApi\Models

 * @method  \TochkaApi\Resources\BaseResource toArray()
 * @method  \TochkaApi\Resources\BaseResource toJSON()
 * @method  \TochkaApi\Resources\BaseResource count()
 */
abstract class BaseModel implements ModelInterface
{
    use DefaultModel;

    /**
     * @var
     */
    protected $app;

    /**
     * @var
     */
    protected $instance;

    /**
     * @var
     */
    protected $resource;

    /**
     * @var array
     */
    protected $excludeActions = [];

    protected $parentVar = "";

    protected $customResource = "";

    /**
     * @var string
     */
    protected $parameters = "";


    /**
     * BaseModel constructor.
     * @param TochkaApi $app
     */
    public function __construct(TochkaApi $app)
    {
        $this->setApp($app);
    }

    /**
     * @return TochkaApi
     */
    public function getApp(): TochkaApi
    {
        return $this->app;
    }

    /**
     * @param TochkaApi $app
     */
    protected function setApp(TochkaApi $app): void
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    protected function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param mixed $instance
     */
    protected function setInstance($instance): void
    {
        $this->instance = $instance;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param mixed $resource
     */
    public function setResource($resource): void
    {
        $this->resource = $resource;
    }

    /**
     * @return mixed
     */
    protected function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    protected function setParameters($parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getParentVar(): string
    {
        return $this->parentVar;
    }

    /**
     * @param string $parentVar
     */
    public function setParentVar(string $parentVar): void
    {
        $this->parentVar = $parentVar;
    }

    /**
     * @return string
     */
    public function getCustomResource(): string
    {
        return $this->customResource;
    }

    /**
     * @param string $customResource
     */
    public function setCustomResource(string $customResource): void
    {
        $this->customResource = $customResource;
    }

    /**
     * @param array $values
     * @return $this
     * @throws /\TochkaApi\Exceptions\ModelNotFoundException
     */
    public function update($values) {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->post($this->getApp()->getEndpoint($this->getInstance(), $this->getParameters()), $this->getApp()->getAccessToken(), $values));
    }

    /**
     * @param array $values
     * @return $this
     * @throws /\TochkaApi\Exceptions\ModelNotFoundException
     */
    public function create($values) {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->post($this->getApp()->getEndpoint($this->getInstance(), $this->getParameters()), $this->getApp()->getAccessToken(), $values));
    }

    /**
     * @return $this|$this[]
     * @throws /\TochkaApi\Exceptions\ModelNotFoundException
     */
    public function list() {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->get($this->getApp()->getEndpoint($this->getInstance(), "list"), $this->getApp()->getAccessToken()));
    }

    /**
     * @param $parameter
     * @return $this
     * @throws /\TochkaApi\Exceptions\ModelNotFoundException
     */
    public function get($parameter = "") {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->get($this->getApp()->getEndpoint($this->getInstance(), $parameter), $this->getApp()->getAccessToken()));
    }

    /**
     * @param $actionName
     * @throws TochkaApiClientException
     */

    private function beforeAction($actionName) {
        $accessToken = $this->getApp()->getAccessToken();

        if($accessToken->isExpired()) {
            $this->getApp()->setAccessToken($this->getApp()->refresh($accessToken->getRefreshToken()));
        }

        $this->performExcludes($actionName);
    }

    /**
     * @param $method
     * @throws TochkaApiClientException
     */
    protected function performExcludes($method) {
        if(in_array($method, $this->excludeActions)) {

            throw new TochkaApiClientException("Method '{$method}' not found in {$this->getInstance()}");
        }
    }

    /**
     * @param ResponseInterface $response
     * @param string $customResource
     * @param string $parentVar
     * @return mixed
     * @throws /\TochkaApi\Exceptions\ModelNotFoundException
     */
    protected function performResponse(ResponseInterface $response, $customResource = "", $parentVar = "") {
        $customResource = $customResource == "" ? $this->getCustomResource() : $customResource;
        $parentVar = $parentVar == "" ? $this->getParentVar() : $parentVar;

        return ResourceFactory::create($this, $response->getArray(), $customResource, $parentVar);
    }

    /**
     * @param $method
     * @param string $parameter
     * @param array $data
     * @param string $customResource
     * @param string $parentVar
     * @return mixed
     */
    protected function requestResponse($method, $parameter = "", $data = [], $customResource = "", $parentVar = "") {
        return $this->performResponse($this->getApp()->getAdapter()->$method($this->getApp()->getEndpoint($this->getInstance(), $parameter), $this->getApp()->getAccessToken(), $data), $customResource, $parentVar);
    }

    /**
     * @param $instance
     * @param string $parameter
     * @return mixed
     */
    protected function belongsTo($instance, $parameter = "") {
        return $this->getApp()->$instance()->get($parameter);
    }

    /**
     * @param $relation
     * @param $parameter
     * @param string $parentVar
     * @return mixed
     */
    protected function belongsToMany($relation, $parameter, $parentVar = "") {
        return $this->requestResponse("get", $parameter, [], $relation, $parentVar);
    }

    /**
     * @param $name
     * @return mixed
     * @throws EntityNotFoundException
     */
    public function __get($name)
    {
        if(!isset($this->getResource()->{$name})) {
            throw new EntityNotFoundException("Field not found");
        }

        return $this->getResource()->{$name};
    }
}