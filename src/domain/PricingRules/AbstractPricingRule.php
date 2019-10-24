<?php declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

use CinemaTicketPricing\TicketPrice;
use CinemaTicketPricing\TicketPriceDeterminants;
use CinemaTicketPricing\PriceFinder;

abstract class AbstractPricingRule implements PricingRuleInterface
{
    protected $determinants;

    private $prices;

    public function __construct(TicketPriceDeterminants $determinants, array $prices)
    {
        $this->determinants = $determinants;
        $this->prices       = $prices;
    }

    abstract public function match(): bool;

    public function value(): TicketPrice
    {
        $finder = new PriceFinder($this->determinants);
        $price = $finder->find($this->prices);
        // finder->find で数値を返す必要あり
        return new TicketPrice($price);
    }
}