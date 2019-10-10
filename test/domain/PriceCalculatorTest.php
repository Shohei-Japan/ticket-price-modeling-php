<?php
declare(strict_types=1);

namespace CinemaTicketPricing\Test;

use PHPUnit\Framework\TestCase;
use CinemaTicketPricing\PriceCalculator;

class PriceCalculatorTest extends TestCase
{
    /**
     * @param int $expected
     * @dataProvider dataInvoke
     */
    public function testInvoke(int $expected)
    {
        $calculator = new PriceCalculator();
        $actual = $calculator->invoke();

        $this->assertSame($expected, $actual);
    }

    public function dataInvoke()
    {
        return [
            '会員,平日' => [
                'expected' => 1000,
            ],
            '会員,平日（レイト）' => [
                'expected' => 1000,
            ],
        ];
    }
}
