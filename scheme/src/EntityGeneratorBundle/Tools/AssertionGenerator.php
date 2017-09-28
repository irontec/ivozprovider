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
        return 'Assertion::notNull($'. $fieldName .');';
    }

    public static function notNullCondition($fieldName)
    {
        return 'if (!is_null($'. $fieldName .')) {';
    }

    public static function boolean($fieldName)
    {
        return 'Assertion::between(intval($'. $fieldName .'), 0, 1);';
    }

    public static function integer($fieldName)
    {
        return 'Assertion::integerish($'. $fieldName .');';
    }

    public static function float($fieldName)
    {
        return 'Assertion::numeric($'. $fieldName .');';
    }

    public static function greaterOrEqualThan($fieldName, $limit)
    {
        return 'Assertion::greaterOrEqualThan($'. $fieldName .', ' . $limit . ');';
    }

    public static function maxLength($fieldName, $maxLength)
    {
        return 'Assertion::maxLength($'. $fieldName .', '. $maxLength .');';
    }

    public static function choice($fieldName, $choices)
    {
        return 'Assertion::choice($'. $fieldName .', '. var_export($choices, true) .');';
    }
}
