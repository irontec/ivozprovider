<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * TransformationRule
 */
class TransformationRule extends TransformationRuleAbstract implements TransformationRuleInterface
{
    use TransformationRuleTrait;

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

    /**
     * {@inheritDoc}
     */
    public function setMatchExpr(?string $matchExpr = null): static
    {
        if (!is_null($matchExpr)) {
            Assertion::regexFormat($matchExpr);
        }

        return parent::setMatchExpr($matchExpr);
    }
}
