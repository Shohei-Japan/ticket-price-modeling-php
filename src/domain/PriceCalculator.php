<?php
declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\PricingRules\GeneralMemberRule;
use CinemaTicketPricing\PricingRules\RegularRule;
use CinemaTicketPricing\PricingRules\PricingRuleInterface;

class PriceCalculator
{
    /**
     * @param TicketPriceDeterminants $determinants
     * @return TicketPrice
     */
    public function invoke(TicketPriceDeterminants $determinants): TicketPrice
    {
        // PricingRules が増えた際に配列にクラスを追加する
        $ruleClasses = [GeneralMemberRule::class];

        foreach ($ruleClasses as $class) {
            /** @var PricingRuleInterface $rule */
            $rule = new $class($determinants);
            if ($rule->match()) {
                return $rule->value();
            }
        }

        return (new RegularRule($determinants))->value();
    }
}
