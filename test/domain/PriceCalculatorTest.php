<?php
declare(strict_types=1);

namespace CinemaTicketPricing\Test;

use CinemaTicketPricing\MovieSchedule;
use CinemaTicketPricing\TicketPrice;
use CinemaTicketPricing\Enums\UserType;
use PHPUnit\Framework\TestCase;
use CinemaTicketPricing\PriceCalculator;
use CinemaTicketPricing\TicketPriceDeterminants;

class PriceCalculatorTest extends TestCase
{
    /**
     * @param int $expected
     * @dataProvider dataInvoke
     * @throws \Exception
     */
    public function testInvoke(int $expected)
    {
        $determinants = new TicketPriceDeterminants(new MovieSchedule('2019-10-10', '17:00'), UserType::MEMBER());
        $calculator   = new PriceCalculator();
        $actual       = $calculator->invoke($determinants);

        $this->assertEquals(new TicketPrice($expected), $actual);
    }

    public function dataInvoke()
    {
        return [
            '会員,平日'      => [
                'expected' => 1000,
            ],
            '会員,平日（レイト）' => [
                'expected' => 1000,
            ],
        ];
    }
}
