<?php

namespace TochkaApi\Resources;


/**
 * Class Response
 * @package TochkaApi\Resources
 */
class Response extends BaseResource
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