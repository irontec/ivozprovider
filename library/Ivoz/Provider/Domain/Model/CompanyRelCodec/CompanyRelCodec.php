<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * CompanyRelCodec
 * @codeCoverageIgnore
 */
class CompanyRelCodec extends CompanyRelCodecAbstract implements CompanyRelCodecInterface
{
    use CompanyRelCodecTrait;

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

    public function setCompany(CompanyInterface $company = null): static
    {
        if (is_null($company)) {
            return parent::setCompany(null);
        }

        $companyType = $company->getType();
        $isValidCompanyType =
            $companyType === CompanyInterface::TYPE_RETAIL ||
            $companyType === CompanyInterface::TYPE_WHOLESALE;

        if (!$isValidCompanyType) {
            throw new \DomainException('CompanyRelCodec can only be associated with retail or wholesale companies');
        }

        return parent::setCompany($company);
    }
}
