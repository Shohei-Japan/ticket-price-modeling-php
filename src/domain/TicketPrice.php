<?php declare(strict_types=1);

namespace TicketPrice;

use CinemaTicketPricing\MovieSchedule;
use CinemaTicketPricing\UserType;

class TicketPrice
{
    private $movieSchedule;

    private $userType;

    public function __construct(MovieSchedule $movieSchedule, UserType $userType)
    {
        $this->movieSchedule = $movieSchedule;
        $this->userType      = $userType;
    }
}