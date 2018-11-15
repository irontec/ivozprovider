<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\Helper\CriteriaHelperInterface;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\Common\Collections\Expr\CompositeExpression;
use Doctrine\Common\Collections\Expr\Expression;

class CriteriaHelper implements CriteriaHelperInterface
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
     * @return Expression[]
     */
    private static function arrayToExpressions(array $conditions)
    {
        $expressions = [];
        foreach ($conditions as $key => $comparison) {
            if (is_string($comparison)) {
                throw new \RuntimeException("Raw (string) conditions cannot be converted into expressions");
            }

            if (!in_array($key, ['or', 'and'], true)) {
                list($field, $operator) = $comparison;
                $value = $comparison[2] ?? null;

                $expressions[] = self::createExpression($field, $operator, $value);
                continue;
            }

            switch ($key) {
                case 'or':
                    $subExpressions = self::arrayToExpressions($comparison);
                    $expressions[] = Criteria::expr()->orX(
                        ...$subExpressions
                    );
                    break;
                case 'and':
                    $subExpressions = self::arrayToExpressions($comparison);
                    $expressions[] = Criteria::expr()->andX(
                        ...$subExpressions
                    );
                    break;
            }
        }

        return $expressions;
    }

    /**
     * @param string $field
     * @param string $operator
     * @param null $value
     * @return Comparison
     */
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
