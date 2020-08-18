<?php

namespace TochkaApi\Models;

/**
 * Class Organization
 * @package TochkaApi\Models
 */
class Organization extends BaseModel implements ModelInterface
{
    /**
     * @var string
     */
    protected $instance = "organization";

    /**
     * @var array
     */
    protected $excludeActions = ["update", "create", "delete", "get"];

    protected $parentVar = "organizations";
}