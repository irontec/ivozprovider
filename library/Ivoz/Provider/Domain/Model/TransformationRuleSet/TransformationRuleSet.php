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
