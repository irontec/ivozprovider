<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

use Assert\Assertion;

/**
 * LcrRule
 */
class LcrRule extends LcrRuleAbstract implements LcrRuleInterface
{
    use LcrRuleTrait;

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
