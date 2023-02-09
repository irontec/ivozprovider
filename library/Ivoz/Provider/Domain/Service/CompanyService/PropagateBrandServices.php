<?php

namespace Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class PropagateBrandServices implements CompanyLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private BrandServiceRepository $brandServiceRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        $isNew = $company->isNew();
        if (!$isNew) {
            return;
        }

        // Only propagate vPBX services
        $companyType = $company->getType();
        if ($companyType != CompanyInterface::TYPE_VPBX) {
            return;
        }

        $services = $this->brandServiceRepository->findByBrandId(
            (int) $company->getBrand()->getId()
        );

        /**
         * @var BrandService $service
         */
        foreach ($services as $service) {
            $companyServiceDto = CompanyService::createDto();


            $serviceId = $service->getService()->getId();
            $serviceIden = $service->getService()->getIden();

            // Only propagate vPBX services
            if (!in_array($serviceIden, Service::VPBX_AVAILABLE_SERVICES, true)) {
                continue;
            }

            $companyServiceDto
                ->setServiceId($serviceId)
                ->setCode($service->getCode())
                ->setCompanyId($company->getId());

            /** @var CompanyServiceInterface $companyService */
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
