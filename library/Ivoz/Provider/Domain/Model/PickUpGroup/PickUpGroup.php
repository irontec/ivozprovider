<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * PickUpGroup
 */
class PickUpGroup extends PickUpGroupAbstract implements PickUpGroupInterface
{
    use PickUpGroupTrait;

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

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('PickUpGroup can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
