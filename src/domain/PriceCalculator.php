<?php
declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\PricingRules\GeneralMemberRule;
use CinemaTicketPricing\PricingRules\PricingRuleInterface;

class PriceCalculator
{
    /**
     * @param TicketPriceDeterminants $determinants
     * @return TicketPrice
     */
    public function invoke(TicketPriceDeterminants $determinants): TicketPrice
    {
        $ruleClasses = [GeneralMemberRule::class];

        foreach ($ruleClasses as $class) {
            /** @var PricingRuleInterface $rule */
            $rule = new $class($determinants);
            if ($rule->match()) {
                return $rule->value();
            }
        }

        // TODO return (new RegularRule($determinants))->value();
        return new TicketPrice(1800);
    }
}
