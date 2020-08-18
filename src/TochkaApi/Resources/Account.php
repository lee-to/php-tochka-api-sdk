<?php

namespace TochkaApi\Resources;

/**
 * Class Account
 * @package TochkaApi\Resources
 */
class Account extends BaseResource
{

    /**
     * @var
     */
    protected $code;

    /**
     * @var
     */
    protected $account_code;

    /**
     * @var
     */
    protected $bank_code;

    /**
     * @var
     */
    protected $currency_code;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getAccountCode()
    {
        return $this->account_code;
    }

    /**
     * @param mixed $account_code
     */
    public function setAccountCode($account_code)
    {
        $this->account_code = $account_code;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }

    /**
     * @param mixed $bank_code
     */
    public function setBankCode($bank_code)
    {
        $this->bank_code = $bank_code;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    /**
     * @param mixed $currency_code
     */
    public function setCurrencyCode($currency_code)
    {
        $this->currency_code = $currency_code;
    }
}