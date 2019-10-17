<?php declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\Enums\ScheduleDateTimeType;

/**
 * Class PriceFinder
 * @package CinemaTicketPricing
 */
class PriceFinder
{
    /**
     * @var TicketPriceDeterminants
     */
    private $determinants;

    /**
     * PriceFinder constructor.
     * @param TicketPriceDeterminants $determinants
     */
    public function __construct(TicketPriceDeterminants $determinants)
    {
        $this->determinants = $determinants;
    }

    public function find(): ScheduleDateTimeType
    {
        $schedule = $this->determinants->movieSchedule->dateTime;
        $date     = $schedule->format('d');

        if ($date === '01') {
            // 映画の日
            return ScheduleDateTimeType::FIRST_DAY();
        }

        $day  = $schedule->format('w');
        $hour = $schedule->format('H');

        $isWeekend = $day === '0' || $day === '6';
        $isLate = $hour > 20;

        if (!$isWeekend) {
            if (!$isLate) {
                return ScheduleDateTimeType::WEEKDAY();
            } else {
                return ScheduleDateTimeType::WEEKDAY_LATE();
            }
        } else {
            if (!$isLate) {
                return ScheduleDateTimeType::WEEKEND();
            } else {
                return ScheduleDateTimeType::WEEKEND_LATE();
            }
        }
    }
}