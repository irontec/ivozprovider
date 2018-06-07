<?php

namespace Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
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
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var BrandServiceRepository
     */
    protected $brandServiceRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        BrandServiceRepository $brandServiceRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->brandServiceRepository = $brandServiceRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    /**
     * @throws \Exception
     */
    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        $services = $this->brandServiceRepository->findBy([
            'brand' => $entity->getBrand()->getId()
        ]);

        /**
         * @var BrandService $service
         */
        foreach ($services as $service) {
            $companyServiceDto = CompanyService::createDto();

            $serviceId = $service->getService()->getId();
            $companyServiceDto
                ->setServiceId($serviceId)
                ->setCode($service->getCode())
                ->setCompanyId($entity->getId());

            $companyService = $this->entityPersister->persistDto($companyServiceDto);
            $entity->addCompanyService($companyService);
        }
    }
}