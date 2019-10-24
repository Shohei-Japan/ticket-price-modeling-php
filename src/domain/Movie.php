<?php
declare(strict_types=1);

namespace CinemaTicketPricing;

use CinemaTicketPricing\Enums\MovieType;

class Movie
{
    /** @var string */
    private $title;

    /** @var \CinemaTicketPricing\Enums\MovieType */
    private $type;

    /**
     * Movie constructor.
     * @param string $title
     * @param MovieType $type
     */
    public function __construct(string $title, MovieType $type)
    {
        $this->title = $title;
        $this->type = $type;
    }
}
