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
    public function stringToUtc(
        string $value,
        string $format = 'Y-m-d H:i:s',
        \DateTimeZone $initialTimeZone = null
    ) {
        $dateTime = \DateTime::createFromFormat(
            $format,
            $value,
            $initialTimeZone
        );

        $utcDateTime = self::ensureUTC($dateTime);

        return $utcDateTime->format($format);
    }

    /**
     * @param mixed $value
     * @param mixed $defaultValue
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
     * @param \Datetime $dateTime
     * @return \Datetime
     */
    public static function ensureUTC(\Datetime $dateTime)
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
     * @param string $value with chinese/mysql format
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

    protected static function getCurrentUtcDateTime()
    {
        $dateTime = new \DateTime(
            null,
            new \DateTimeZone('UTC')
        );

        return $dateTime;
    }
}
