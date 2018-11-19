<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\EntityTools;
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
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => 10
        ];
    }

    public function execute(CompanyInterface $company)
    {
        $isNew = $company->isNew();
        if (!$isNew) {
            return;
        }

        /**
         * @var $dto CompanyDTO
         */
        $dto = $this->entityTools->entityToDto($company);
        if (!$dto->getMediaRelaySetsId()) {
            $dto->setMediaRelaySetsId(0);
            $this
                ->entityTools
                ->updateEntityByDto($company, $dto);
        }
    }
}
