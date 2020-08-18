<?php

namespace TochkaApi\Models;

/**
 * Class Payment
 * @package TochkaApi\Models
 */
class Payment extends BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $instance = "payment";

    /**
     * @var array
     */
    protected $excludeActions = ["list", "update", "get"];

    /**
     * @param $request_id
     * @return mixed
     */
    public function status($request_id) {
        return $this->belongsToMany("PaymentStatus", "status/{$request_id}");
    }
}