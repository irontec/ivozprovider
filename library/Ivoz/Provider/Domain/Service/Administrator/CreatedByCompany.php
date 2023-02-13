<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class CreatedByCompany implements CompanyLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        $isNew = $company->isNew();
        if (!$isNew) {
            return;
        }

        // Create a new TpDerivedCharger when brand is created
        $administratorDto = Administrator::createDto();

        /** @var int $companyId */
        $companyId = $company->getId();
        /** @var int $brandId */
        $brandId = $company->getBrand()->getId();

        $administratorDto
            ->setUsername(
                '__c' . $companyId . '_internal'
            )
            ->setPass(
                '[internal]'
            )
            ->setBrandId(
                $brandId
            )
            ->setCompanyId(
                $companyId
            )
            ->setActive(false)
            ->setRestricted(false)
            ->setInternal(true);

        $this->entityTools->persistDto(
            $administratorDto,
            null
        );
    }
}
