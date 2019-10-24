<?php declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

use CinemaTicketPricing\TicketPriceDeterminants;

class RegularRule extends AbstractPricingRule
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