<?php
declare(strict_types=1);

namespace CinemaTicketPricing\PricingRules;

class GeneralMemberRule extends AbstractPricingRule
{
    public function match(): bool
    {
        return true;
    }
}
