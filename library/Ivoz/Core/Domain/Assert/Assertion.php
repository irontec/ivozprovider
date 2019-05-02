<?php

namespace Ivoz\Core\Domain\Assert;

use Assert\Assertion as BaseAssertion;

class Assertion extends BaseAssertion
{
    const INVALID_REGEX_FORMAT = 501;

    /**
     * @return true
     */
    public static function regexFormat($pattern, $message = null, $propertyPath = null): bool
    {
        static::string($pattern, $message, $propertyPath);

        $pattern = '/' . str_replace('/', '\/', $pattern) . '/';

        if (@preg_match($pattern, null) === false) {
            $message = \sprintf(
                static::generateMessage($message) ?: '"%s" is not a valid regexp',
                static::stringify($pattern)
            );

            throw static::createException(
                $pattern,
                $message,
                static::INVALID_REGEX_FORMAT,
                $propertyPath,
                array('pattern' => $pattern)
            );
        }

        return true;
    }
}
