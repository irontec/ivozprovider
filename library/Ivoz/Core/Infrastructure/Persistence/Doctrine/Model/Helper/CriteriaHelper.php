<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;
use Doctrine\Common\Collections\Expr\Expression;
use Doctrine\Common\Collections\Expr\Value;
use Ivoz\Core\Domain\Model\Helper\CriteriaHelperInterface;

class CriteriaHelper implements CriteriaHelperInterface
{
    const VALID_COMPOSITION_KEYS = [
        'or',
        'and'
    ];

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
     *      ['or' => array(
     *          array('field1', 'like', '%field1Value%'),
     *          array('field2', 'like', '%field2Value%')
     *      )],
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
     * @param mixed $condition
     * @return bool
     */
    public static function isWrappedCondition($condition): bool
    {
        /**
         * True for ['or' => [...]] conditions
         */
        $isConditionWrapper =
            is_array($condition)
            && count($condition) === 1
            && in_array(key($condition), self::VALID_COMPOSITION_KEYS, true);

        return $isConditionWrapper;
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

            $isConditionWrapper = self::isWrappedCondition($comparison);

            if ($isConditionWrapper) {
                $response = self::arrayToExpressions($comparison);
                $expressions[] = current($response);
                continue;
            }

            if (!in_array($key, self::VALID_COMPOSITION_KEYS, true)) {
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

        if (strtoupper($operator) === Comparison::IN && is_scalar($value)) {
            $value = [$value];
        }

        return $expr->{$operator}($field, $value);
    }

    ////////////////////////////////////////////////
    /// toArray
    ////////////////////////////////////////////////

    /**
     * @param Criteria $criteria
     * @return array
     */
    public static function toArray(Criteria $criteria): array
    {
        /** @var CompositeExpression $whereExpression */
        $whereExpression = $criteria->getWhereExpression();
        $expressionType = $whereExpression->getType();

        /** @var CompositeExpression[] | Comparison[] $expressionList */
        $expressionList = $whereExpression->getExpressionList();
        $expressions = self::expressionListToArray($expressionList);
        $expressions = self::simplifyExpressionList($expressions);

        if ($expressionType === CompositeExpression::TYPE_AND) {
            return $expressions;
        }

        return [$expressionType => $expressions];
    }

    /**
     * @param array $expressions
     * @return array
     */
    private static function simplifyExpressionList(array $expressions): array
    {
        $response = [];
        foreach ($expressions as $expression) {
            $type = strtolower(key($expression));
            if (!is_numeric($type)
                && count($expression) === 1
                && !array_key_exists($type, $response)
            ) {
                $currentExpression = current($expression);
                $response[$type] = self::simplifyExpressionList($currentExpression);
                continue;
            }

            $response[] = $expression;
        }

        return $response;
    }

    /**
     * @param  CompositeExpression[] | Comparison[] $expressionList
     *
     * @return array
     */
    private static function expressionListToArray(array $expressionList)
    {
        $response = [];
        foreach ($expressionList as $expression) {
            if ($expression instanceof Comparison) {
                /** @var Comparison $expression */
                $response[] = self::comparisonToArray($expression);
                continue;
            }

            $response[] = self::expressionToArray($expression);
        }

        return $response;
    }

    /**
     * @param CompositeExpression $expression
     * @return array
     */
    private static function expressionToArray(CompositeExpression $expression)
    {
        $type = strtolower(
            $expression->getType()
        );
        $conditions = [];

        /** @var CompositeExpression[] | Comparison[] $expressionList */
        $expressionList = $expression->getExpressionList();

        return [
            $type => self::expressionListToArray($expressionList)
        ];
    }

    /**
     * @param Comparison $comparison
     * @return array
     */
    private static function comparisonToArray(Comparison $comparison)
    {
        return [
            $comparison->getField(),
            self::operatorMap(
                $comparison->getOperator()
            ),
            $comparison->getValue()->getValue()
        ];
    }

    private static function operatorMap(string $operator): string
    {
        $values = [
            '=' => 'eq',
            '<>' => 'neq',
            '<' => 'lt',
            '<=' => 'LTE',
            '>' => 'GT',
            '>=' => 'GTE',
            'in' => 'IN',
            'nin' => 'NIN',
            'constains' => 'CONTAINS',
            'member_of' => 'MEMBER_OF',
            'starts_with' => 'STARTS_WITH',
            'ends_with' => 'ENDS_WITH'
        ];

        return $values[strtolower($operator)];
    }

    ////////////////////////////////////////////////
    /// append
    ////////////////////////////////////////////////

    /**
     * @param string $operator
     * @param Criteria $baseCriteria
     * @param Criteria ...$criteriasToAppend
     * @return Criteria
     */
    public static function append(string $operator, Criteria $baseCriteria, Criteria ...$criteriasToAppend): Criteria
    {
        $operator = strtoupper($operator);
        if (!in_array($operator, [CompositeExpression::TYPE_OR, CompositeExpression::TYPE_AND])) {
            throw new \InvalidArgumentException('Unkown operator ' . $operator);
        }

        /** @var CompositeExpression $baseExpression */
        $expression = self::simplifyCompositeExpression(
            $baseCriteria->getWhereExpression()
        );

        foreach ($criteriasToAppend as $criteria) {
            $newExpression = self::simplifyCompositeExpression(
                $criteria->getWhereExpression()
            );

            $expression = new CompositeExpression(
                $operator,
                [
                    $expression,
                    $newExpression
                ]
            );
        }

        return new Criteria($expression);
    }

    private static function simplifyCompositeExpression(CompositeExpression $expression): CompositeExpression
    {
        $expressionList = $expression->getExpressionList();
        $firstExpression = current($expressionList);
        $isAndCondition = $expression->getType() === CompositeExpression::TYPE_AND;

        if ($isAndCondition && count($expressionList) === 1) {
            return $firstExpression;
        }

        return $expression;
    }
}
