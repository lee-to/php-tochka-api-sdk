<?php

namespace TochkaApi\Resources;

/**
 * Class Statement
 * @package TochkaApi\Resources
 */
class Statement extends BaseResource
{
    /**
     * @var
     */
    protected $request_id;

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
    protected $date_end;

    /**
     * @var
     */
    protected $date_start;

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
    public function getAccountCode()
    {
        return $this->account_code;
    }

    /**
     * @param mixed $account_code
     */
    public function setAccountCode($account_code): void
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
    public function setBankCode($bank_code): void
    {
        $this->bank_code = $bank_code;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd() : \DateTime
    {
        return $this->date_end;
    }

    /**
     * @param mixed $date_end
     */
    public function setDateEnd($date_end): void
    {
        $this->date_end = new \DateTime($date_end);
    }

    /**
     * @return \DateTime
     */
    public function getDateStart() : \DateTime
    {
        return $this->date_start;
    }

    /**
     * @param mixed $date_start
     */
    public function setDateStart($date_start): void
    {
        $this->date_start = new \DateTime($date_start);
    }


}