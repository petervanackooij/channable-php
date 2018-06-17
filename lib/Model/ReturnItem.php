<?php

namespace Channable\Model;

class ReturnItem
{
    /**
     * @var int
     */
    private $catalogItemId;

    /**
     * @var int
     */
    private $ean;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var string
     */
    private $comment;

    public function __construct(int $catalogItemId, int $ean, int $quantity, string $reason, string $comment)
    {
        $this->catalogItemId = $catalogItemId;
        $this->ean = $ean;
        $this->quantity = $quantity;
        $this->reason = $reason;
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getCatalogItemId()
    {
        return $this->catalogItemId;
    }

    /**
     * @return int
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
