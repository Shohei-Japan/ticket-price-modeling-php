<?php
declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

use CinemaTicketPricing\TicketPrice;
use CinemaTicketPricing\TicketPriceDeterminants;

class GeneralMemberRule implements PricingRuleInterface
{
    private $determinants;

    public function __construct(TicketPriceDeterminants $determinants)
    {
        $this->determinants = $determinants;
    }

    public function match(): bool
    {
        return true;
    }

    public function value(): TicketPrice
    {
        return new TicketPrice(1000);
    }
}
