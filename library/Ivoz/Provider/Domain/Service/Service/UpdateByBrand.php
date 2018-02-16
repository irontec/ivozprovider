<?php
namespace Ivoz\Provider\Domain\Service\Service;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        ServiceRepository $serviceRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->serviceRepository = $serviceRepository;
    }

    public function execute(BrandInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        $services = $this->serviceRepository->findAll();

        /**
         * @var Service $service
         */
        foreach ($services as $service) {

            $brandServiceDto = BrandService::createDto();
            $brandServiceDto
                ->setServiceId($service->getId())
                ->setCode($service->getDefaultCode())
                ->setBrandId($entity->getId());

            $this->entityPersister->persistDto($brandServiceDto);
        }
    }
}