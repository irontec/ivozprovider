<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * CompanyRelRoutingTag
 * @codeCoverageIgnore
 */
class CompanyRelRoutingTag extends CompanyRelRoutingTagAbstract implements CompanyRelRoutingTagInterface
{
    use CompanyRelRoutingTagTrait;

    /**
     * @param CompanyInterface|null $company
     * @return static
     */
    public function setCompany(CompanyInterface $company = null): static
    {
        $companyType = $company->getType();
        $validCompanyTypes = [
            CompanyInterface::TYPE_RETAIL,
            CompanyInterface::TYPE_WHOLESALE,
        ];

        if (!in_array($companyType, $validCompanyTypes)) {
            $erroMsg = sprintf(
                'Company type must be either %s or %s',
                CompanyInterface::TYPE_RETAIL,
                CompanyInterface::TYPE_WHOLESALE
            );

            throw new \DomainException($erroMsg);
        }

        return parent::setCompany($company);
    }

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
