<?php

namespace TochkaApi\Resources;

/**
 * Class Payment
 * @package TochkaApi\Resources
 */
class Payment extends BaseResource
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
    protected $counterparty_account_number;

    /**
     * @var
     */
    protected $counterparty_bank_bic;

    /**
     * @var
     */
    protected $counterparty_inn;

    /**
     * @var
     */
    protected $counterparty_kpp;

    /**
     * @var
     */
    protected $counterparty_name;

    /**
     * @var
     */
    protected $payment_amount;

    /**
     * @var
     */
    protected $payment_date;

    /**
     * @var
     */
    protected $payment_number;

    /**
     * @var
     */
    protected $payment_priority;

    /**
     * @var
     */
    protected $payment_purpose;

    /**
     * @var
     */
    protected $payment_purpose_code;

    /**
     * @var
     */
    protected $supplier_bill_id;

    /**
     * @var
     */
    protected $tax_info_document_date;

    /**
     * @var
     */
    protected $tax_info_document_number;

    /**
     * @var
     */
    protected $tax_info_kbk;

    /**
     * @var
     */
    protected $tax_info_okato;

    /**
     * @var
     */
    protected $tax_info_period;

    /**
     * @var
     */
    protected $tax_info_reason_code;

    /**
     * @var
     */
    protected $tax_info_status;

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
     * @return mixed
     */
    public function getCounterpartyAccountNumber()
    {
        return $this->counterparty_account_number;
    }

    /**
     * @param mixed $counterparty_account_number
     */
    public function setCounterpartyAccountNumber($counterparty_account_number): void
    {
        $this->counterparty_account_number = $counterparty_account_number;
    }

    /**
     * @return mixed
     */
    public function getCounterpartyBankBic()
    {
        return $this->counterparty_bank_bic;
    }

    /**
     * @param mixed $counterparty_bank_bic
     */
    public function setCounterpartyBankBic($counterparty_bank_bic): void
    {
        $this->counterparty_bank_bic = $counterparty_bank_bic;
    }

    /**
     * @return mixed
     */
    public function getCounterpartyInn()
    {
        return $this->counterparty_inn;
    }

    /**
     * @param mixed $counterparty_inn
     */
    public function setCounterpartyInn($counterparty_inn): void
    {
        $this->counterparty_inn = $counterparty_inn;
    }

    /**
     * @return mixed
     */
    public function getCounterpartyKpp()
    {
        return $this->counterparty_kpp;
    }

    /**
     * @param mixed $counterparty_kpp
     */
    public function setCounterpartyKpp($counterparty_kpp): void
    {
        $this->counterparty_kpp = $counterparty_kpp;
    }

    /**
     * @return mixed
     */
    public function getCounterpartyName()
    {
        return $this->counterparty_name;
    }

    /**
     * @param mixed $counterparty_name
     */
    public function setCounterpartyName($counterparty_name): void
    {
        $this->counterparty_name = $counterparty_name;
    }

    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->payment_amount;
    }

    /**
     * @param mixed $payment_amount
     */
    public function setPaymentAmount($payment_amount): void
    {
        $this->payment_amount = $payment_amount;
    }

    /**
     * @return mixed
     */
    public function getPaymentDate()
    {
        return $this->payment_date;
    }

    /**
     * @param mixed $payment_date
     */
    public function setPaymentDate($payment_date): void
    {
        $this->payment_date = $payment_date;
    }

    /**
     * @return mixed
     */
    public function getPaymentNumber()
    {
        return $this->payment_number;
    }

    /**
     * @param mixed $payment_number
     */
    public function setPaymentNumber($payment_number): void
    {
        $this->payment_number = $payment_number;
    }

    /**
     * @return mixed
     */
    public function getPaymentPriority()
    {
        return $this->payment_priority;
    }

    /**
     * @param mixed $payment_priority
     */
    public function setPaymentPriority($payment_priority): void
    {
        $this->payment_priority = $payment_priority;
    }

    /**
     * @return mixed
     */
    public function getPaymentPurpose()
    {
        return $this->payment_purpose;
    }

    /**
     * @param mixed $payment_purpose
     */
    public function setPaymentPurpose($payment_purpose): void
    {
        $this->payment_purpose = $payment_purpose;
    }

    /**
     * @return mixed
     */
    public function getPaymentPurposeCode()
    {
        return $this->payment_purpose_code;
    }

    /**
     * @param mixed $payment_purpose_code
     */
    public function setPaymentPurposeCode($payment_purpose_code): void
    {
        $this->payment_purpose_code = $payment_purpose_code;
    }

    /**
     * @return mixed
     */
    public function getSupplierBillId()
    {
        return $this->supplier_bill_id;
    }

    /**
     * @param mixed $supplier_bill_id
     */
    public function setSupplierBillId($supplier_bill_id): void
    {
        $this->supplier_bill_id = $supplier_bill_id;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoDocumentDate()
    {
        return $this->tax_info_document_date;
    }

    /**
     * @param mixed $tax_info_document_date
     */
    public function setTaxInfoDocumentDate($tax_info_document_date): void
    {
        $this->tax_info_document_date = $tax_info_document_date;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoDocumentNumber()
    {
        return $this->tax_info_document_number;
    }

    /**
     * @param mixed $tax_info_document_number
     */
    public function setTaxInfoDocumentNumber($tax_info_document_number): void
    {
        $this->tax_info_document_number = $tax_info_document_number;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoKbk()
    {
        return $this->tax_info_kbk;
    }

    /**
     * @param mixed $tax_info_kbk
     */
    public function setTaxInfoKbk($tax_info_kbk): void
    {
        $this->tax_info_kbk = $tax_info_kbk;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoOkato()
    {
        return $this->tax_info_okato;
    }

    /**
     * @param mixed $tax_info_okato
     */
    public function setTaxInfoOkato($tax_info_okato): void
    {
        $this->tax_info_okato = $tax_info_okato;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoPeriod()
    {
        return $this->tax_info_period;
    }

    /**
     * @param mixed $tax_info_period
     */
    public function setTaxInfoPeriod($tax_info_period): void
    {
        $this->tax_info_period = $tax_info_period;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoReasonCode()
    {
        return $this->tax_info_reason_code;
    }

    /**
     * @param mixed $tax_info_reason_code
     */
    public function setTaxInfoReasonCode($tax_info_reason_code): void
    {
        $this->tax_info_reason_code = $tax_info_reason_code;
    }

    /**
     * @return mixed
     */
    public function getTaxInfoStatus()
    {
        return $this->tax_info_status;
    }

    /**
     * @param mixed $tax_info_status
     */
    public function setTaxInfoStatus($tax_info_status): void
    {
        $this->tax_info_status = $tax_info_status;
    }
}