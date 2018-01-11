<?php

namespace spec\Ivoz\Provider\Domain\Service\Service;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Ivoz\Provider\Domain\Service\Service\UpdateByBrand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByBrandSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    public function let(
        EntityPersisterInterface $entityPersister,
        ServiceRepository $serviceRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->serviceRepository = $serviceRepository;

        $this->beConstructedWith($entityPersister, $serviceRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByBrand::class);
    }

    function it_does_nothing_if_not_new(
        BrandInterface $entity
    ) {
        $this
            ->serviceRepository
            ->findAll()
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }

    function it_creates_brand_services(
        BrandInterface $entity,
        ServiceInterface $service
    ) {
        $this
            ->serviceRepository
            ->findAll()
            ->willReturn([$service]);

        $this
            ->entityPersister
            ->persistDto(Argument::type(BrandServiceDto::class))
            ->shouldBeCalled();

        $this->execute($entity, true);
    }
}
