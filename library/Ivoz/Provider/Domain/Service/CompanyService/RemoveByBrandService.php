<?php

namespace Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Service\BrandService\BrandServiceLifecycleEventHandlerInterface;

class RemoveByBrandService implements BrandServiceLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var CompanyServiceRepository
     */
    private $companyServiceRepository;

    function __construct(
        EntityTools $entityTools,
        CompanyRepository $companyRepository,
        CompanyServiceRepository $companyServiceRepository
    ) {
        $this->entityTools = $entityTools;
        $this->companyRepository = $companyRepository;
        $this->companyServiceRepository = $companyServiceRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(BrandServiceInterface $entity)
    {
        /** @var int[] $companyIds */
        $companyIds = $this->companyRepository->findIdsByBrandId(
            $entity->getBrand()->getId()
        );

        foreach ($companyIds as $companyId) {
            $companyService = $this->companyServiceRepository->findCompanyService(
                $companyId,
                $entity->getService()->getId()
            );

            // Delete custom company service code
            if ($companyService) {
                $this->entityTools->remove($companyService);
            }
        }
    }
}
