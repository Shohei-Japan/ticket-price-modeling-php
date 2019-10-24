<?php
declare(strict_types=1);

namespace CinemaTicketPricing;

class MovieSchedule
{
    /** @var string */
    public $dateTime;

    /**
     * MovieSchedule constructor.
     * @param string $date
     * @param string $time
     * @throws \Exception
     */
    public function __construct(string $date, string $time)
    {
        $this->dateTime = new \DateTimeImmutable($date . " " . $time);
    }
}
