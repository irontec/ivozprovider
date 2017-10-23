<?php
namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
 * Class SanitizeEmptyValues
 * @package Ivoz\Provider\Domain\Service\Brand
 * @lifecycle pre_persist
 */
class SanitizeEmptyValues implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    /**
     * @param BrandInterface $entity
     */
    public function execute(BrandInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /**
         * @var $dto BrandDTO
         */
        $dto = $entity->toDTO();
        // Create sane defaults for hidden fields

        if (!$dto->getDefaultTimezoneId()) {
            $dto->setDefaultTimezoneId(145);
        }

        if (!$dto->getLanguageId()) {
            $dto->setLanguageId(1);
        }

        $this->entityPersister->persistDto($dto, $entity);
    }
}