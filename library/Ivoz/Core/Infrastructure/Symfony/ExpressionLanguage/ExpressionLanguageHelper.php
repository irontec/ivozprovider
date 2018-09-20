<?php

namespace Ivoz\Core\Infrastructure\Symfony\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ExpressionLanguageHelper implements CriteriaHelperInterface
{
    /**
     * @param array $conditions
     * @return Criteria
     *
     * @example
     * $criteria = [
     *      'or' => array(
     *          array('field1', 'like', '%field1Value%'),
     *          array('field2', 'like', '%field2Value%')
     *      ),
     *      'and' => array(
     *          array('field3', 'eq', 3),
     *          array('field4', 'eq', 'four')
     *      ),
     *      array('field5', 'neq', 5)
     * ];
     */
    public static function fromArray(array $conditions)
    {
        if (empty($conditions)) {
            throw new \DomainException('Empty $conditions found');
        }

        $criteria = Criteria::create();
        $compositeExpression = new CompositeExpression(
            CompositeExpression::TYPE_AND,
            self::arrayToExpressions($conditions)
        );
        $criteria->where($compositeExpression);

        return $criteria;
    }

    /**
     * @param array $conditions
     * @return \Doctrine\Common\Collections\Expr\Comparison|\Doctrine\Common\Collections\Expr\CompositeExpression
     */
    private static function arrayToExpressions(array $conditions)
    {
        $expressions = [];
        foreach ($conditions as $comparison) {
            list($field, $operator) = $comparison;
            $value = $comparison[2] ?? null;

            switch ($operator) {
                case 'or':
                    $subExpressions = self::arrayToExpressions($value);
                    $expressions[] = Criteria::expr()->orX(
                        ...$subExpressions
                    );
                    break;
                case 'and':
                    $subExpressions = self::arrayToExpressions($value);
                    $expressions[] = Criteria::expr()->andX(
                        ...$subExpressions
                    );
                    break;
                default:
                    $expressions[] = self::createExpression($field, $operator, $value);
                    break;
            }
        }

        return $expressions;
    }

    private static function createExpression(string $field, string $operator, $value = null)
    {
        $expr = Criteria::expr();

        if ($operator === 'isNull') {
            return $expr->isNull($field);
        }
        if ($operator === 'isNotNull') {
            return new Comparison($field, Comparison::NEQ, new Value(null));
        }

        return $expr->{$operator}($field, $value);
    }
}
