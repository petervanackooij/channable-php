<?php

namespace Channable\Model;

class Offer
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var float
     */
    public $price;

    /**
     * @var int
     */
    public $stock;

    public function __construct(int $id, string $title, float $price, int $stock)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->stock = $stock;
    }
}
