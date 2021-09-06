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

    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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
}
