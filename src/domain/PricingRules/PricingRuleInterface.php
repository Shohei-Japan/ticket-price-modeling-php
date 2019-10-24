<?php
declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

use CinemaTicketPricing\TicketPrice;
use CinemaTicketPricing\TicketPriceDeterminants;

interface PricingRuleInterface
{
    public function __construct(TicketPriceDeterminants $determinants, array $prices);

    public function match(): bool;

    public function value(): TicketPrice;
}
