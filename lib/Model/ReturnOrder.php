<?php

namespace Channable\Model;

class ReturnOrder
{
    /**
     * @var string
     */
    private $marketplaceOrderId;

    /**
     * @var int
     */
    private $intermediaryOrderId;

    /**
     * @var ReturnItem[]
     */
    private $returnItems;

    public function __construct(string $marketplaceOrderId, int $intermediaryOrderId, array $returnItems)
    {
        $this->marketplaceOrderId = $marketplaceOrderId;
        $this->intermediaryOrderId = $intermediaryOrderId;
        $this->returnItems = $returnItems;
    }

    /**
     * @return string
     */
    public function getMarketplaceOrderId()
    {
        return $this->marketplaceOrderId;
    }

    /**
     * @return int
     */
    public function getIntermediaryOrderId()
    {
        return $this->intermediaryOrderId;
    }

    /**
     * @return ReturnItem[]
     */
    public function getReturnItems()
    {
        return $this->returnItems;
    }
}
