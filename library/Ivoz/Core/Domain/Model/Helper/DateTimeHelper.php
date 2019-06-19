<?php

namespace Ivoz\Core\Domain\Model\Helper;

class DateTimeHelper
{
    /**
     * @param string $value
     * @param string $format
     * @param \DateTimeZone|null $initialTimeZone
     * @return string
     */
    public static function stringToUtc(
        string $value,
        string $format = 'Y-m-d H:i:s',
        \DateTimeZone $initialTimeZone = null
    ) {
        $dateTime = \DateTime::createFromFormat(
            $format,
            $value,
            $initialTimeZone
        );

        if (!$dateTime) {
            throw new \RuntimeException($value . ' is not a valid datetime');
        }

        $utcDateTime = self::ensureUTC($dateTime);

        return $utcDateTime->format($format);
    }

    /**
     * @param mixed $value
     * @param mixed $defaultValue
     *
     * @return null|false|\DateTime
     */
    public static function createOrFix($value = null, $defaultValue = null)
    {
        if (empty($value) && empty($defaultValue)) {
            return null;
        }

        if (empty($value)) {
            $value = $defaultValue;
        }

        if ($value instanceof \DateTime) {
            return self::ensureUTC($value);
        }

        if (is_string($value)) {
            if (strtolower($value) === 'current_timestamp') {
                return self::getCurrentUtcDateTime();
            }

            return self::createFromString($value);
        }

        throw new \Exception('Unkown format');
    }

    /**
     * @param \DateTime $dateTime
     * @return \DateTime
     */
    public static function ensureUTC(\DateTime $dateTime)
    {
        $timeZoneName = $dateTime
            ->getTimezone()
            ->getName();

        if ($timeZoneName !== 'UTC') {
            $dateTime->setTimezone(
                new \DateTimeZone('UTC')
            );
        }

        return $dateTime;
    }

    /**
     * Adds an interval to a datetime and fixes month add related issues
     * @see https://stackoverflow.com/questions/3602405/php-datetimemodify-adding-and-subtracting-months
     * @param \DateTime $dateTime
     * @param \DateInterval $interval
     * @return \DateTime
     */
    public static function add(\DateTime $dateTime, \DateInterval $interval) :\DateTime
    {
        $response = clone $dateTime;
        $response->add($interval);

        $monthOperation = !$interval->d && $interval->m;
        if (!$monthOperation || !self::islastDayOfMonth($dateTime)) {
            return $response;
        }

        $initialMonth = (int) $dateTime->format('m');
        $resultMonth = (int) $response->format('m');

        $diff = $resultMonth - $initialMonth;
        if ($diff < 0) {
            $diff = 12 + $diff;
        }

        if ($diff > $interval->m) {
            $response->modify('last day of previous month');
        } else {
            $response->modify('last day of this month');
        }

        return $response;
    }

    /**
     * Subtracts an interval to a datetime and fixes month sub related issues
     * @see https://stackoverflow.com/questions/3602405/php-datetimemodify-adding-and-subtracting-months
     * @param \DateTime $dateTime
     * @param \DateInterval $interval
     * @return \DateTime
     */
    public static function sub(\DateTime $dateTime, \DateInterval $interval) :\DateTime
    {
        $response = clone $dateTime;
        $response->sub($interval);

        $monthOperation = !$interval->d && $interval->m;
        if (!$monthOperation || !self::islastDayOfMonth($dateTime)) {
            return $response;
        }

        $initialMonth = (int) $dateTime->format('m');
        $resultMonth = (int) $response->format('m');

        $diff = $initialMonth - $resultMonth;
        if ($diff < 0) {
            $diff = 12 + $diff;
        }

        if ($diff < $interval->m) {
            $response->modify('last day of previous month');
        } else {
            $response->modify('last day of this month');
        }

        return $response;
    }

    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public static function islastDayOfMonth(\DateTime $dateTime): bool
    {
        $clonedDateTime = clone $dateTime;
        $clonedDateTime->modify('last day of this month');

        return $clonedDateTime == $dateTime;
    }

    /**
     * @param string $value with chinese/mysql format
     *
     * @return false|\DateTime
     */
    protected static function createFromString(string $value)
    {
        $format = $value;

        //Date part
        $format = preg_replace('/^[0-9]{4}\-/', 'Y-', $format);
        $format = preg_replace('/^[0-9]{2}\-/', 'y-', $format);
        $format = preg_replace('/\-[0-9]{2}\-/', '-m-', $format);
        $format = preg_replace('/\-[0-9]{2}/', '-d', $format);

        //Time part
        $format = preg_replace('/\:[0-9]{2}\:/', ':i:', $format);
        $format = preg_replace('/\:[0-9]{2}/', ':s', $format);
        $format = preg_replace('/[0-9]{2}\:/', 'H:', $format);
        $format = preg_replace('/[0-9]{1}\:/', 'h:', $format);

        $dateTimeZone = strlen($format) == strlen('Y-m-d H:i:s')
            ? new \DateTimeZone('UTC')
            : null;

        return \DateTime::createFromFormat(
            $format,
            $value,
            $dateTimeZone
        );
    }

    protected static function getCurrentUtcDateTime(): \DateTime
    {
        $dateTime = new \DateTime(
            null,
            new \DateTimeZone('UTC')
        );

        return $dateTime;
    }
}
