<?php
namespace Ivoz\Provider\Domain\Model\LcrRuleTarget;

/**
 * LcrRuleTarget
 */
class LcrRuleTarget extends LcrRuleTargetAbstract implements LcrRuleTargetInterface
{
    use LcrRuleTargetTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

