<?php

namespace TochkaApi\Models;

/**
 * Class Salary
 * @package TochkaApi\Models
 */
class Salary extends BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $instance = "salary";

    /**
     * @var array
     */
    protected $excludeActions = ["list", "update", "get", "create"];

    /**
     * @param $customer_code
     * @return mixed
     */
    public function employeeList($customer_code) {
        return $this->requestResponse("post", "employee/list", ["customer_code" => $customer_code], "Salary");
    }

    /**
     * @param $customer_code
     * @param array $employees
     * @return mixed
     */
    public function employeeAdd($customer_code, array $employees) {
        return $this->requestResponse("post", "employee/add", ["customer_code" => $customer_code, "employees" => $employees], "Salary");
    }

    /**
     * @param array $customer
     * @param array $payments
     * @param $payment_period_start_date
     * @param $payment_period_end_date
     * @param $purpose_id
     * @return mixed
     */
    public function payrollCreate(array $customer, array $payments, $payment_period_start_date, $payment_period_end_date, $purpose_id) {
        return $this->requestResponse("post", "payroll/create", ["customer" => $customer, "payments" => $payments, "payment_period_start_date" => $payment_period_start_date, "payment_period_end_date" => $payment_period_end_date, "purpose_id" => $purpose_id], "Salary");
    }

    /**
     * @return mixed
     */
    public function purposes() {
        return $this->requestResponse("get", "purposes", [], "Salary");
    }

    /**
     * @param $request_id
     * @return mixed
     */
    public function result($request_id) {
        return $this->requestResponse("post", "result", ["request_id" => $request_id], "Salary");
    }
}