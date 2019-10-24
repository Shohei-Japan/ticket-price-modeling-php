<?php declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\Enums\UserType;

class TicketPriceDeterminants
{
    /** @var MovieSchedule */
    public $movieSchedule;

    /** @var UserType */
    private $userType;

    public function __construct(MovieSchedule $movieSchedule, UserType $userType)
    {
        $this->movieSchedule = $movieSchedule;
        $this->userType      = $userType;
    }

    public function isThreeD(): bool
    {
        return true;
    }
}
