<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelRoutingTag;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

class CheckCompanyType implements CompanyRelRoutingTagLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string,integer>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(CompanyRelRoutingTagInterface $entity): void
    {
        $company = $entity->getCompany();
        if (!$company) {
            throw new \DomainException('CompanyRelRoutingTag without assigned company');
        }

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
    }
}
