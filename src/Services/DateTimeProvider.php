<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Services;

use DateTime;
use DateTimeZone;

class DateTimeProvider
{
    public static function getCurrent(): DateTime
    {
        $currentDate = new DateTime();
        $currentDate->setTimezone(new DateTimeZone(date_default_timezone_get()));

        return $currentDate;
    }
}
