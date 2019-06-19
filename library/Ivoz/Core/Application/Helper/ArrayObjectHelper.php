<?php

namespace Ivoz\Core\Application\Helper;

class ArrayObjectHelper
{
    public static function parseResurively(\ArrayObject $object): array
    {
        $response = [];
        foreach ($object as $key => $value) {
            $response[$key] = self::parseValue($value);
        }
        return $response;
    }

    private static function parseValue($value)
    {
        if ($value instanceof \ArrayObject) {
            return self::parseResurively($value);
        }

        if (is_array($value)) {
            $response = [];
            foreach ($value as $k => $v) {
                $response[$k] = self::parseValue($v);
            }
            return $response;
        }

        return $value;
    }
}
