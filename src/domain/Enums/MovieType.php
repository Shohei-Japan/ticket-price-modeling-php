<?php
declare(strict_types=1);

namespace CinemaTicketPricing\Enums;

use MyCLabs\Enum\Enum;

/**
 * Class MovieType
 * @package CinemaTicketPricing
 *
 * @method static static GENERAL()
 * @method static static THREE_D()
 * @method static static GOKUJYO()
 */
class MovieType extends Enum
{
    private const GENERAL = '通常';
    private const THREE_D = '3D';
    private const GOKUJYO = '極上爆音';
}
