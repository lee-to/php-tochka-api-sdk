<?php

namespace TochkaApi\Resources;


/**
 * Class StatementStatus
 * @package TochkaApi\Resources
 */
class StatementStatus extends BaseResource
{
    /**
     * @var
     */
    protected $request_id;

    /**
     * @var
     */
    protected $status;

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * @param mixed $request_id
     */
    public function setRequestId($request_id): void
    {
        $this->request_id = $request_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}