<?php declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

use CinemaTicketPricing\TicketPrice;
use CinemaTicketPricing\TicketPriceDeterminants;
use CinemaTicketPricing\PriceFinder;

class RegularRule extends AbstractPricingRule implements PricingRuleInterface
{
    public function __construct(TicketPriceDeterminants $determinants, array $prices)
    {
        parent::__construct($determinants, $prices);
    }

    public function match(): bool
    {
        return true;
    }
}