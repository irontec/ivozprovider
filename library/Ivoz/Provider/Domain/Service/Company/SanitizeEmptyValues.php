<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
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

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => 10
        ];
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /**
         * @var $dto CompanyDTO
         */
        $dto = $entity->toDto();
        if (!$dto->getMediaRelaySetsId()) {
            $dto->setMediaRelaySetsId(0);
        }

        $this->entityUpdater->execute($entity, $dto);
    }
}