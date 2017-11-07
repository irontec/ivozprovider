<?php
namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
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
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    public function __construct(
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->entityUpdater = $entityUpdater;
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

        $this->entityUpdater->execute($entity, $dto);
    }
}