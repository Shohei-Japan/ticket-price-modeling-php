<?php declare(strict_types=1);

namespace CinemaTicketPricing\Test;

use CinemaTicketPricing\Enums\ScheduleType;
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
     * @param ScheduleType $expected
     * @dataProvider handleDateTimeProvider
     * @throws \Exception
     */
    public function testCanFind(String $date, String $time, int $expected)
    {
        $determinants = new TicketPriceDeterminants(
            new MovieSchedule($date, $time),
            UserType::MEMBER()
        );

        $finder = new PriceFinder($determinants);
        $actual = $finder->find($this->prices());

        $this->assertSame($actual, $expected);
    }

    /**
     * @return array
     */
    public function handleDateTimeProvider()
    {
        return [
            'movie day' => [
                'date' => '2019-10-01',
                'time' => '12:00',
                'expected' => 1000
            ],
            'weekday, daytime' => [
                'date' => '2019-10-18',
                'time' => '12:00',
                'expected' => 1100
            ],
            'weekday, late' => [
                'date' => '2019-10-18',
                'time' => '21:00',
                'expected' => 1300
            ],
            'weekend, daytime' => [
                'date' => '2019-10-20',
                'time' => '12:00',
                'expected' =>1500
            ],
            'weekend, late' => [
                'date' => '2019-10-20',
                'time' => '22:00',
                'expected' => 1800
            ],
        ];
    }

    /**
     * @param String $date
     * @param String $time
     * @param ScheduleType $expected
     * @dataProvider handleWrongDateTimeProvider
     * @throws \Exception
     */
    public function testCannotFind(String $date, String $time, int $expected)
    {
        $determinants = new TicketPriceDeterminants(
            new MovieSchedule($date, $time),
            UserType::MEMBER()
        );

        $finder = new PriceFinder($determinants);
        $actual = $finder->find($this->prices());

        $this->assertNotSame($actual, $expected);
    }

    /**
     * @return array
     */
    public function handleWrongDateTimeProvider()
    {
        return [
            'movie day' => [
                'date' => '2019-10-01',
                'time' => '12:00',
                'expected' => 3000
            ],
            'weekday, daytime' => [
                'date' => '2019-10-18',
                'time' => '12:00',
                'expected' => 3000
            ],
            'weekday, late' => [
                'date' => '2019-10-18',
                'time' => '21:00',
                'expected' => 3000
            ],
            'weekend, daytime' => [
                'date' => '2019-10-20',
                'time' => '12:00',
                'expected' => 3000
            ],
            'weekend, late' => [
                'date' => '2019-10-20',
                'time' => '22:00',
                'expected' => 3000
            ],
        ];
    }

    /**
     * @return array
     */
    private function prices()
    {
        return [
            ScheduleType::MOVIE_DAY()->getValue()    => '1000',
            ScheduleType::WEEKDAY()->getValue()      => '1100',
            ScheduleType::WEEKDAY_LATE()->getValue() => '1300',
            ScheduleType::WEEKEND()->getValue()      => '1500',
            ScheduleType::WEEKEND_LATE()->getValue() => '1800',
        ];
    }
}