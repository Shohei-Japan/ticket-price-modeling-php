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
    public function testInvoke(
        UserType $userType,
        string $date,
        string $time,
        int $expected
    ) {
        $determinants = new TicketPriceDeterminants(
            new MovieSchedule($date, $time),
            $userType
        );
        $calculator   = new PriceCalculator();
        $actual       = $calculator->invoke($determinants);

        $this->assertEquals(new TicketPrice($expected), $actual);
    }

    public function dataInvoke()
    {
        return [
            '会員,平日'      => [
                'userType' => UserType::MEMBER(),
                'date' => '2019-10-10',
                'time' => '17:00',
                'expected' => 1000,
            ],
            '会員,平日（レイト）' => [
                'userType' => UserType::MEMBER(),
                'date' => '2019-10-10',
                'time' => '21:00',
                'expected' => 1000,
            ],
            '非会員,平日'      => [
                'userType' => UserType::STUDENT1(),
                'date' => '2019-10-10',
                'time' => '17:00',
                'expected' => 1000,
            ],
            '非会員,平日（レイト）' => [
                'userType' => UserType::STUDENT1(),
                'date' => '2019-10-10',
                'time' => '21:00',
                'expected' => 1000,
            ],
        ];
    }
}
