<?php

namespace TochkaApi\Resources;


/**
 * Class Salary
 * @package TochkaApi\Resources
 */
class Salary extends BaseResource
{
    /**
     * @var
     */
    protected $responseData;

    /**
     * @return mixed
     */
    public function getResponseData()
    {
        return $this->responseData;
    }

    /**
     * @param mixed $responseData
     */
    public function setResponseData($responseData): void
    {
        $this->responseData = $responseData;
    }
}