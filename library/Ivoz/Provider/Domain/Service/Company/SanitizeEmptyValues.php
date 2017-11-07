<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * Class SanitizeEmptyValues
 * @package Ivoz\Provider\Domain\Service\Company
 * @lifecycle pre_persist
 */
class SanitizeEmptyValues implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    public function __construct(
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->entityUpdater = $entityUpdater;
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /**
         * @var $dto CompanyDTO
         */
        $dto = $entity->toDTO();

        if (!$dto->getDefaultTimezoneId()) {
            $dto->setDefaultTimezoneId(
                // @todo create a shortcut
                $entity->getBrand()->getDefaultTimezone()->getId()
            );
        }

        if (!$dto->getLanguageId()) {
            $dto->setLanguageId(
                // @todo create a shortcut
                $entity->getBrand()->getLanguage()->getId()
            );
        }

        if (!$dto->getMediaRelaySetsId()) {
            $dto->setMediaRelaySetsId(0);
        }

        if (!$dto->getIpFilter()) {
            $dto->setIpFilter(0);
        }

        if (!$dto->getOnDemandRecord()) {
            $dto->setOnDemandRecord(0);
        }

        if (!$dto->getOnDemandRecordCode()) {
            $dto->setOnDemandRecordCode('');
        }


        $this->entityUpdater->execute($entity, $dto);
    }
}