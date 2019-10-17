<?php

declare(strict_types=1);

namespace CinemaTicketPricing\Enums;

use MyCLabs\Enum\Enum;

/**
 * Class UserType
 * @package CinemaTicketPricing
 *
 * @method static static MEMBER()
 * @method static static MEMBER_SENIOR()
 * @method static static SENIOR()
 * @method static static STUDENT1()
 * @method static static STUDENT2()
 * @method static static CHILD()
 * @method static static HANDICAPPED1()
 * @method static static HANDICAPPED2()
 */
class UserType extends Enum
{
    private const MEMBER        = 'シネマシティズン';
    private const MEMBER_SENIOR = 'シネマシティズン（60才以上）';
    private const SENIOR        = 'シニア';
    private const STUDENT1      = '学生（大・専）';
    private const STUDENT2      = '中・高校生';
    private const CHILD         = '幼児（3才以上）・小学生';
    private const HANDICAPPED1  = '障がい者（学生以上）';
    private const HANDICAPPED2  = '障がい者（高校以下）';
}
