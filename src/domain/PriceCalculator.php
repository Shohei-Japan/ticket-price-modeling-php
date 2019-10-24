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
                ScheduleType::MOVIE_DAY()->getKey()    => '1000',
                ScheduleType::WEEKDAY()->getKey()      => '1000',
                ScheduleType::WEEKDAY_LATE()->getKey() => '1000',
                ScheduleType::WEEKEND()->getKey()      => '1000',
                ScheduleType::WEEKEND_LATE()->getKey() => '1000',
            ],
            RegularRule::class => [
                ScheduleType::MOVIE_DAY()->getKey()    => '1800',
                ScheduleType::WEEKDAY()->getKey()      => '1300',
                ScheduleType::WEEKDAY_LATE()->getKey() => '1800',
                ScheduleType::WEEKEND()->getKey()      => '1300',
                ScheduleType::WEEKEND_LATE()->getKey() => '1100',
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
