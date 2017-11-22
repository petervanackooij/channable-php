<?php

namespace Channable\Model;

class Price
{
    /**
     * @var float
     */
    private $commission;

    /**
     * @var float
     */
    private $transactionFee;

    /**
     * @var float
     */
    private $shipping;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $total;

    /**
     * @var float
     */
    private $subtotal;

    public function __construct(
        float $commission,
        float $transactionFee,
        float $shipping,
        string $paymentMethod,
        string $currency,
        float $total,
        float $subtotal
    ) {
        $this->commission = $commission;
        $this->transactionFee = $transactionFee;
        $this->shipping = $shipping;
        $this->paymentMethod = $paymentMethod;
        $this->currency = $currency;
        $this->total = $total;
        $this->subtotal = $subtotal;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }

    /**
     * @return float
     */
    public function getTransactionFee(): float
    {
        return $this->transactionFee;
    }

    /**
     * @return float
     */
    public function getShipping(): float
    {
        return $this->shipping;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }
}
