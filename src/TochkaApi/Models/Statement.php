<?php

namespace TochkaApi\Models;

/**
 * Class Statement
 * @package TochkaApi\Models
 */
class Statement extends BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $instance = "statement";

    /**
     * @var array
     */
    protected $excludeActions = ["list", "update", "get"];

    /**
     * @param $request_id
     * @return mixed
     */
    public function status($request_id) {
        return $this->belongsToMany("StatementStatus", "status/{$request_id}");
    }

    /**
     * @param $request_id
     * @return mixed
     */
    public function result($request_id) {
        return $this->belongsToMany("StatementResult", "result/{$request_id}");
    }
}