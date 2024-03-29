<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

/**
 * FeaturesRelCompany
 */
class FeaturesRelCompany extends FeaturesRelCompanyAbstract implements FeaturesRelCompanyInterface
{
    use FeaturesRelCompanyTrait;

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
