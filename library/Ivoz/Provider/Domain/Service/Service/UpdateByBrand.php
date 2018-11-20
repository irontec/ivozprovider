<?php
namespace Ivoz\Provider\Domain\Service\Service;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    public function __construct(
        EntityTools $entityTools,
        ServiceRepository $serviceRepository
    ) {
        $this->entityTools = $entityTools;
        $this->serviceRepository = $serviceRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    public function execute(BrandInterface $entity)
    {
        $isNew = $entity->isNew();
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

            $brandService = $this->entityTools->persistDto($brandServiceDto);
            $entity->addService($brandService);
        }
    }
}
