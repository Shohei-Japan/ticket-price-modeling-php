<?php
declare(strict_types=1);

namespace CinemaTicketPricing;

class MovieSchedule
{
    /** @var string */
    private $date;

    /** @var string */
    private $time;

    public function __construct(string $date, string $time)
    {
        $this->date = $date;
        $this->time = $time;
    }
}
