<?php

namespace TochkaApi\Resources;

/**
 * Class Organization
 * @package TochkaApi\Resources
 */
class Organization extends BaseResource
{
    /**
     * @var
     */
    protected $customer_code;

    /**
     * @var
     */
    protected $full_name;

    /**
     * @var
     */
    protected $tax_code;

    /**
     * @var array
     */
    protected $accounts = [];

    /**
     * @return mixed
     */
    public function getCustomerCode()
    {
        return $this->customer_code;
    }

    /**
     * @param mixed $customer_code
     */
    public function setCustomerCode($customer_code)
    {
        $this->customer_code = $customer_code;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    /**
     * @return mixed
     */
    public function getTaxCode()
    {
        return $this->tax_code;
    }

    /**
     * @param mixed $tax_code
     */
    public function setTaxCode($tax_code)
    {
        $this->tax_code = $tax_code;
    }

    /**
     * @return array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param $accounts
     * @throws \TochkaApi\Exceptions\ModelNotFoundException
     */
    public function setAccounts($accounts)
    {
        $this->accounts = ResourceFactory::create(null, $accounts, "Account");
    }
}