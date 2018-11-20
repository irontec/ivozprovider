<?php

namespace Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class PropagateBrandServices
 */
class PropagateBrandServices implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var BrandServiceRepository
     */
    protected $brandServiceRepository;

    public function __construct(
        EntityTools $entityTools,
        BrandServiceRepository $brandServiceRepository
    ) {
        $this->entityTools = $entityTools;
        $this->brandServiceRepository = $brandServiceRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    /**
     * @param CompanyInterface $company
     */
    public function execute(CompanyInterface $company)
    {
        $isNew = $company->isNew();
        if (!$isNew) {
            return;
        }

        $services = $this->brandServiceRepository->findByBrandId(
            $company->getBrand()->getId()
        );

        /**
         * @var BrandService $service
         */
        foreach ($services as $service) {
            $companyServiceDto = CompanyService::createDto();

            $serviceId = $service->getService()->getId();
            $companyServiceDto
                ->setServiceId($serviceId)
                ->setCode($service->getCode())
                ->setCompanyId($company->getId());

            $companyService = $this->entityTools->persistDto($companyServiceDto);

            $company
                ->addCompanyService($companyService);
        }

        $this->entityTools
            ->dispatchQueuedOperations();

        $this->entityTools
            ->persist($company);
    }
}
