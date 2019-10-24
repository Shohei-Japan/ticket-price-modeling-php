<?php
declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\Enums\ScheduleType;
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
        $ruleClasses = [
            GeneralMemberRule::class,
            RegularRule::class,
        ];

        $prices = [
            GeneralMemberRule::class => [
                ScheduleType::MOVIE_DAY    => '1000',
                ScheduleType::WEEKDAY      => '1000',
                ScheduleType::WEEKDAY_LATE => '1000',
                ScheduleType::WEEKEND      => '1000',
                ScheduleType::WEEKEND_LATE => '1000',
            ],
            RegularRule::class => [
                ScheduleType::MOVIE_DAY    => '1800',
                ScheduleType::WEEKDAY      => '1300',
                ScheduleType::WEEKDAY_LATE => '1800',
                ScheduleType::WEEKEND      => '1300',
                ScheduleType::WEEKEND_LATE => '1100',
            ],
        ];

        foreach ($ruleClasses as $class) {
            /** @var PricingRuleInterface $rule */
            $rule = new $class($determinants, $prices[$class]);
            if ($rule->match()) {
                return $rule->value();
            }
        }
        return (new RegularRule($determinants, $prices[RegularRule::class]))->value();
    }
}
