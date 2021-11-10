<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

/**
 * TrunksLcrRuleTarget
 */
class TrunksLcrRuleTarget extends TrunksLcrRuleTargetAbstract implements TrunksLcrRuleTargetInterface
{
    use TrunksLcrRuleTargetTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
