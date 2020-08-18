<?php

namespace TochkaApi\Models;


/**
 * Interface ModelInterface
 * @package TochkaApi\Models
 */
interface ModelInterface
{
    /**
     * @return mixed
     */
    public function getModelName();

    /**
     * @param $resource
     * @return mixed
     */
    public function setResource($resource);
}