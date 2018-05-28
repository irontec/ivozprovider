<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Assert\Assertion;

/**
 * LcrRule
 */
class TrunksLcrRule extends TrunksLcrRuleAbstract implements TrunksLcrRuleInterface
{
    use TrunksLcrRuleTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
