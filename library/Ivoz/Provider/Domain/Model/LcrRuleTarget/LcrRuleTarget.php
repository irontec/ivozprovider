<?php
namespace Ivoz\Provider\Domain\Model\LcrRuleTarget;

/**
 * LcrRuleTarget
 */
class LcrRuleTarget extends LcrRuleTargetAbstract implements LcrRuleTargetInterface
{
    use LcrRuleTargetTrait;

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

