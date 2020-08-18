<?php

namespace TochkaApi\Resources;


/**
 * Class StatementResult
 * @package TochkaApi\Resources
 */
class StatementResult extends BaseResource
{
    /**
     * @var
     */
    protected $request_id;

    /**
     * @var
     */
    protected $balance_closing;

    /**
     * @var
     */
    protected $balance_opening;

    /**
     * @var array
     */
    protected $payments = [];

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
    public function getBalanceClosing()
    {
        return $this->balance_closing;
    }

    /**
     * @param mixed $balance_closing
     */
    public function setBalanceClosing($balance_closing): void
    {
        $this->balance_closing = $balance_closing;
    }

    /**
     * @return mixed
     */
    public function getBalanceOpening()
    {
        return $this->balance_opening;
    }

    /**
     * @param mixed $balance_opening
     */
    public function setBalanceOpening($balance_opening): void
    {
        $this->balance_opening = $balance_opening;
    }

    /**
     * @return array
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param array $payments
     */
    public function setPayments(array $payments): void
    {
        $this->payments = $payments;
    }
}