<?php

namespace Channable\Model;

class Order
{
    /**
     * @var int
     */
    private $intermediaryOrderId;

    /**
     * @var string
     */
    private $marketplaceOrderId;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var Address
     */
    private $shipping;

    /**
     * @var Address
     */
    private $billing;

    /**
     * @var Extra
     */
    private $extra;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var \DateTime
     */
    private $created;

    public function __construct(
        int $intermediaryOrderId,
        string $marketplaceOrderId,
        array $products,
        Customer $customer,
        Address $shipping,
        Address $billing,
        Extra $extra,
        Price $price,
        \DateTime $created
    ) {
        $this->intermediaryOrderId = $intermediaryOrderId;
        $this->marketplaceOrderId = $marketplaceOrderId;
        $this->products = $products;
        $this->customer = $customer;
        $this->shipping = $shipping;
        $this->billing = $billing;
        $this->extra = $extra;
        $this->price = $price;
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getIntermediaryOrderId(): int
    {
        return $this->intermediaryOrderId;
    }

    /**
     * @return int
     */
    public function getMarketplaceOrderId(): string
    {
        return $this->marketplaceOrderId;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Address
     */
    public function getShipping(): Address
    {
        return $this->shipping;
    }

    /**
     * @return Address
     */
    public function getBilling(): Address
    {
        return $this->billing;
    }

    /**
     * @return Extra
     */
    public function getExtra(): Extra
    {
        return $this->extra;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }
}
