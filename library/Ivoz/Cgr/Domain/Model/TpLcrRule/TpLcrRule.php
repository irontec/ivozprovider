<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

/**
 * TpLcrRule
 */
class TpLcrRule extends TpLcrRuleAbstract implements TpLcrRuleInterface
{
    use TpLcrRuleTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
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
