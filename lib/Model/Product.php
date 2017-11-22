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
     * @var \DateTime
     */
    private $deliveryPeriod;

    public function __construct(
        int $quantity,
        string $ean,
        float $commission,
        int $id,
        string $referenceCode,
        float $shipping,
        string $title,
        float $price,
        \DateTime $deliveryPeriod
    ) {
        $this->quantity = $quantity;
        $this->ean = $ean;
        $this->commission = $commission;
        $this->id = $id;
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
     * @return \DateTime
     */
    public function getDeliveryPeriod(): \DateTime
    {
        return $this->deliveryPeriod;
    }
}
