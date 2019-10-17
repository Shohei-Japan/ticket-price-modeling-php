<?php declare(strict_types=1);

namespace CinemaTicketPricing\Test;

use CinemaTicketPricing\Enums\ScheduleDateTimeType;
use CinemaTicketPricing\Enums\UserType;
use CinemaTicketPricing\MovieSchedule;
use CinemaTicketPricing\PriceFinder;
use CinemaTicketPricing\TicketPriceDeterminants;
use PHPUnit\Framework\TestCase;

/**
 * Class PriceFinderTest
 * @package CinemaTicketPricing\Test
 */
class PriceFinderTest extends TestCase
{
    /**
     * @param String $date
     * @param String $time
     * @param ScheduleDateTimeType $expected
     * @dataProvider handleDateTimeProvider
     * @throws \Exception
     */
    public function testFind(String $date, String $time, ScheduleDateTimeType $expected)
    {
        $determinants = new TicketPriceDeterminants(
            new MovieSchedule($date, $time),
            UserType::MEMBER()
        );
        $finder = new PriceFinder($determinants);
        $actual = $finder->find();

        $this->assertEquals($actual, $expected);
    }

    /**
     * @return array
     */
    public function handleDateTimeProvider()
    {
        return [
            'first day' => [
                'date' => '2019-10-01',
                'time' => '12:00',
                'expected' => ScheduleDateTimeType::FIRST_DAY()
            ],
            'weekday, daytime' => [
                'date' => '2019-10-18',
                'time' => '12:00',
                'expected' => ScheduleDateTimeType::WEEKDAY()
            ],
            'weekday, late' => [
                'date' => '2019-10-18',
                'time' => '21:00',
                'expected' => ScheduleDateTimeType::WEEKDAY_LATE()
            ],
            'weekend, daytime' => [
                'date' => '2019-10-20',
                'time' => '12:00',
                'expected' => ScheduleDateTimeType::WEEKEND()
            ],
            'weekend, late' => [
                'date' => '2019-10-20',
                'time' => '22:00',
                'expected' => ScheduleDateTimeType::WEEKEND_LATE()
            ],
        ];
    }
}