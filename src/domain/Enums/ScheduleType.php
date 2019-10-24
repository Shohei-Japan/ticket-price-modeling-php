<?php
declare(strict_types=1);

namespace CinemaTicketPricing\Enums;

use CinemaTicketPricing\MovieSchedule;
use MyCLabs\Enum\Enum;

/**
 * Class ScheduleType
 * @package CinemaTicketPricing
 *
 * @method static static WEEKDAY()
 * @method static static WEEKDAY_LATE()
 * @method static static WEEKEND()
 * @method static static WEEKEND_LATE()
 * @method static static MOVIE_DAY()
 */
class ScheduleType extends Enum
{
    public const WEEKDAY      = '平日';
    public const WEEKDAY_LATE = '平日/レイトショー';
    public const WEEKEND      = '土日';
    public const WEEKEND_LATE = '土日/レイトショー';
    public const MOVIE_DAY    = '映画の日';

    public static function createScheduleType(MovieSchedule $schedule): ScheduleType
    {
        $date     = $schedule->dateTime->format('d');

        if ($date === '01') {
            // 映画の日
            return ScheduleType::MOVIE_DAY();
        }

        $day  = $schedule->dateTime->format('w');
        $hour = $schedule->dateTime->format('H');

        $isWeekend = $day === '0' || $day === '6';
        $isLate = $hour >= 20;

        if (!$isWeekend) {
            if (!$isLate) {
                return ScheduleType::WEEKDAY();
            } else {
                return ScheduleType::WEEKDAY_LATE();
            }
        } else {
            if (!$isLate) {
                return ScheduleType::WEEKEND();
            } else {
                return ScheduleType::WEEKEND_LATE();
            }
        }

    }
}
