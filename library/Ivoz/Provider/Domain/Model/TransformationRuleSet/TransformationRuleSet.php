<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Assert\Assertion;

/**
 * TransformationRuleSet
 */
class TransformationRuleSet extends TransformationRuleSetAbstract implements TransformationRuleSetInterface
{
    use TransformationRuleSetTrait;

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


    protected function sanitizeValues(): void
    {
        $notNew = !$this->isNew();
        $brandHasChanged = $this->hasChanged('brandId');

        if ($notNew && $brandHasChanged) {
            $errorMsg = $this->getBrand()
                ? 'Unable to convert a generic numeric transformation into a brand numeric transformation'
                : 'Unable to convert a brand numeric transformation into a generic numeric transformation';

            throw new \DomainException($errorMsg, 403);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setInternationalCode(?string $internationalCode = null): static
    {
        if (!empty($internationalCode)) {
            Assertion::regex($internationalCode, '/^[0-9]{2,10}$/');
        }

        return parent::setInternationalCode($internationalCode);
    }

    /**
     * {@inheritDoc}
     */
    public function setTrunkPrefix(?string $trunkPrefix = null): static
    {
        if (!empty($trunkPrefix)) {
            Assertion::regex($trunkPrefix, '/^[0-9]+$/');
        }

        return parent::setTrunkPrefix($trunkPrefix);
    }
}
