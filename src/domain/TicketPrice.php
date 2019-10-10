<?php declare(strict_types=1);

namespace CinemaTicketPricing;

class TicketPrice
{
    /** @var int */
    private $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function add(TicketPrice $another)
    {
        return new static($this->price + $another->price);
    }
}
