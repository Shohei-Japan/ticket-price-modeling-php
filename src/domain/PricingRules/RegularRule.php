<?php declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

class RegularRule extends AbstractPricingRule
{
    public function match(): bool
    {
        return true;
    }
}