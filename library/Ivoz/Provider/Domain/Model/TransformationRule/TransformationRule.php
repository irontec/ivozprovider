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

    protected function sanitizeValues(): void
    {
        $notNew = !$this->isNew();
        $transformationRuleSetHasChanged = $this->hasChanged('transformationRuleSetId');

        if ($notNew && $transformationRuleSetHasChanged) {
            $errorMsg = 'Unable to update transformation rule set value in a transformation rule';
            throw new \DomainException($errorMsg, 403);
        }
    }
}
