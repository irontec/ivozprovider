<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * UsersCdr
 */
class UsersCdr extends UsersCdrAbstract implements UsersCdrInterface
{
    use UsersCdrTrait;

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

    protected function setCompany(CompanyInterface $company = null): static
    {
        if (is_null($company)) {
            return parent::setCompany(null);
        }

        $companyType = $company->getType();
        $isValidCompanyType = $companyType === CompanyInterface::TYPE_VPBX;

        if (!$isValidCompanyType) {
            throw new \DomainException('UsersCdr can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
