<?php

namespace Channable\Model;

class Product
{
    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $ean;

    /**
     * @var float
     */
    private $commission;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $referenceCode;

    /**
     * @var float
     */
    private $shipping;

    /**
     * @var string
     */
    private $title;

    /**
     * @var float
     */
    private $price;

    /**
     * @var \DateTime|null
     */
    private $deliveryPeriod;

    /**
     * Product constructor.
     * @param int $id
     * @param int $quantity
     * @param string $ean
     * @param float $commission
     * @param string $referenceCode
     * @param float $shipping
     * @param string $title
     * @param float $price
     * @param \DateTime|null $deliveryPeriod
     */
    public function __construct(
        int $id,
        int $quantity,
        string $ean,
        float $commission,
        string $referenceCode,
        float $shipping,
        string $title,
        float $price,
        $deliveryPeriod
    ) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->ean = $ean;
        $this->commission = $commission;
        $this->referenceCode = $referenceCode;
        $this->shipping = $shipping;
        $this->title = $title;
        $this->price = $price;
        $this->deliveryPeriod = $deliveryPeriod;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getReferenceCode(): string
    {
        return $this->referenceCode;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveryPeriod()
    {
        return $this->deliveryPeriod;
    }
}
