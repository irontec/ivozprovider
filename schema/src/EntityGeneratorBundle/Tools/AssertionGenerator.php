<?php

namespace EntityGeneratorBundle\Tools;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class AssertionGenerator
{
    public static function notNull($fieldName)
    {
        $message = $fieldName . ' value "%s" is null, but non null value was expected.';
        return "Assertion::notNull($". $fieldName .", '". $message ."');";
    }

    public static function notNullCondition($fieldName)
    {
        return 'if (!is_null($'. $fieldName .')) {';
    }

    public static function boolean($fieldName, $spaces = '')
    {
        $message = $fieldName . ' provided "%s" is not a valid boolean value.';
        return
            "Assertion::between(intval($". $fieldName ."), 0, 1, '". $message ."');\n"
            . $spaces
            ."$" . $fieldName . " = (bool) $". $fieldName .";";
    }

    public static function integer($fieldName)
    {
        $message = $fieldName . ' value "%s" is not an integer or a number castable to integer.';
        return "Assertion::integerish($". $fieldName . ", '". $message ."');";
    }

    public static function float($fieldName)
    {
        $message = $fieldName . ' value "%s" is not numeric.';
        return "Assertion::numeric($". $fieldName .");";
    }

    public static function greaterOrEqualThan($fieldName, $limit)
    {
        $message = $fieldName . ' provided "%s" is not greater or equal than "%s".';
        return "Assertion::greaterOrEqualThan($". $fieldName .", " . $limit . ", '". $message ."');";
    }

    public static function maxLength($fieldName, $maxLength)
    {
        $message = $fieldName . ' value "%s" is too long, it should have no more than %d characters, but has %d characters.';
        return "Assertion::maxLength($" . $fieldName . ", " . $maxLength . ", '". $message ."');";
    }

    public static function choice($fieldName, $choices, $extraTab = false)
    {
        $message = $fieldName . 'value "%s" is not an element of the valid values: %s';
        $response = "Assertion::choice($" . $fieldName . ", " . $choices . ", '" . $message . "');";

        if ($extraTab) {
            $response = str_replace("\n", "\n" . str_repeat(" ", 4), $response);
            $response = str_repeat(" ", 4) . $response;
        }

        return $response;
    }
}
