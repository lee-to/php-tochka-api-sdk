<?php

namespace TochkaApi\Models;

/**
 * Class Account
 * @package TochkaApi\Models
 */
class Account extends BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $instance = "account";

    /**
     * @var array
     */
    protected $excludeActions = ["update", "create", "delete", "get"];
}