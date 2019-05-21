<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class SanitizeEmptyValues implements CompanyLifecycleEventHandlerInterface
{
    protected $entityTools;

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

    /**
     * @return void
     */
    public function execute(CompanyInterface $company)
    {
        $isNew = $company->isNew();
        if (!$isNew) {
            return;
        }

        /**
         * @var CompanyDto $dto
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
