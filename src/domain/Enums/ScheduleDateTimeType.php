<?php
declare(strict_types=1);

namespace CinemaTicketPricing\Enums;

use MyCLabs\Enum\Enum;

/**
 * Class ScheduleDateTimeType
 * @package CinemaTicketPricing
 *
 * @method static static WEEKDAY()
 * @method static static WEEKDAY_LATE()
 * @method static static WEEKEND()
 * @method static static WEEKEND_LATE()
 * @method static static FIRST_DAY()
 */
class ScheduleDateTimeType extends Enum
{
    private const WEEKDAY      = '平日';
    private const WEEKDAY_LATE = '平日/レイトショー';
    private const WEEKEND      = '土日';
    private const WEEKEND_LATE = '土日/レイトショー';
    private const FIRST_DAY    = '映画の日';
}
