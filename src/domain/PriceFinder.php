<?php declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\Enums\ScheduleType;

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

    public function find(array $prices): int
    {
        foreach ($prices as $key => $price) {
            $type = new ScheduleType($key);
            if (!$type) {
                throw new \InvalidArgumentException('not a ScheduleType key');
            }
        }
        $schedule = $this->determinants->movieSchedule;
        $scheduleType = ScheduleType::getScheduleType($schedule);

        return (int)$prices[$scheduleType->getValue()];
    }
}