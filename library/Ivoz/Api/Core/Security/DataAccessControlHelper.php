<?php

namespace Ivoz\Api\Core\Security;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;

class DataAccessControlHelper
{
    const COMPOSITORS = [
        'and' => CompositeExpression::TYPE_AND,
        'or' => CompositeExpression::TYPE_OR
    ];

    /**
     * @param array $dataAccessControl
     * @return Criteria
     */
    public static function toCriteria(array $dataAccessControl): Criteria
    {
        if (empty($dataAccessControl)) {
            return Criteria::create();
        }

        return CriteriaHelper::fromArray($dataAccessControl);
    }

    /**
     * @param array $dataAccessControl
     * @param string $compositionExpression
     * @return string | void
     */
    public static function toString(array $dataAccessControl, string $compositionExpression = 'and')
    {
        $validExpression = in_array(
            strtoupper($compositionExpression),
            self::COMPOSITORS,
            true
        );

        if (!$validExpression) {
            throw new \DomainException("Unexpected composition expression");
        }

        $expressions = [];
        foreach ($dataAccessControl as $index => $comparison) {
            if (is_string($comparison)) {
                $expressions[] = $comparison;
                continue;
            }

            if (!is_numeric($index)) {
                $expressions[] = self::toString($comparison, $index);
                continue;
            }

            if (count($comparison) === 1) {
                $expressions[] = self::toString(
                    current($comparison),
                    key($comparison)
                );
                continue;
            }

            list($field, $operator) = $comparison;
            $value = $comparison[2] ?? null;

            switch ($operator) {
                case 'or':
                    $expressions[] = self::toString($value, $operator);
                    break;
                case 'and':
                    $expressions[] = self::toString($value, $operator);
                    break;
                default:
                    $expressions[] = self::createExpression($field, $operator, $value);
                    break;
            }
        }

        $expressions = array_filter($expressions, function ($item) {
            $notEmpty = !empty($item);
            return $notEmpty;
        });

        if (empty($expressions)) {
            return;
        }

        $accessControlString =
            '('
            . implode(") $compositionExpression (", $expressions)
            . ')';

        return $accessControlString;
    }

    private static function createExpression(string $field, string $operator, $value = null)
    {
        if ($operator === 'isNull') {
            return "$field == null";
        }

        if ($operator === 'isNotNull') {
            return "$field != null";
        }

        $operator = self::transformOperator($operator);
        $value = self::transformValue($value);

        return "$field $operator $value";
    }

    private static function transformValue($value)
    {
        if (is_null($value)) {
            return 'null';
        }

        if (is_numeric($value)) {
            return $value;
        }

        if (is_string($value)) {
            return "'" . $value . "'";
        }

        if (is_array($value)) {
            foreach ($value as &$val) {
                $val = self::transformValue($val);
            }
            return '[' . implode(',', $value) . ']';
        }
    }

    private static function transformOperator(string $operator)
    {
        $operator = strtoupper($operator);
        switch ($operator) {
            case 'EQ':
                return '==';
            case 'NEQ':
                return '!=';
            case Comparison::IN:
                return 'in';
            case Comparison::NIN:
                return 'not in';
            case Comparison::CONTAINS:
                throw new \Exception('CONTAINS operator has not been implemented yet');
            case Comparison::STARTS_WITH:
                throw new \Exception('STARTS_WITH operator has not been implemented yet');
            case Comparison::ENDS_WITH:
                throw new \Exception('ENDS_WITH operator has not been implemented yet');
            default:
                return constant(Comparison::class . '::' . $operator);
        }
    }
}
