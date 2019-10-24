<?php
declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

use CinemaTicketPricing\TicketPrice;
use CinemaTicketPricing\TicketPriceDeterminants;

class GeneralMemberRule implements PricingRuleInterface
{
    private $determinants;

    private $prices;

    public function __construct(TicketPriceDeterminants $determinants, array $prices)
    {
        $this->determinants = $determinants;
        $this->prices       = $prices;
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
