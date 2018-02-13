<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\Helper\CriteriaHelperInterface;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\Common\Collections\Expr\CompositeExpression;

class CriteriaHelper implements  CriteriaHelperInterface
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
                    $expressions[] = Criteria::expr()->orX(
                        self::arrayToExpressions($comparison)
                    );
                    break;
                case 'and':
                    $expressions[] = Criteria::expr()->andX(
                        self::arrayToExpressions($comparison)
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