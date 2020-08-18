<?php

namespace TochkaApi\Resources;


/**
 * Interface ResourceInterface
 * @package TochkaApi\Resources
 */
interface ResourceInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param array $sourceArray
     * @return mixed
     */
    public function fromArray(array $sourceArray);

    /**
     * @return mixed
     */
    public function toJSON();

    /**
     * @return mixed
     */
    public function toArray();
}