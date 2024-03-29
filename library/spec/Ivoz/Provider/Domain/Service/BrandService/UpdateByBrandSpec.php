<?php

namespace spec\Ivoz\Provider\Domain\Service\BrandService;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Ivoz\Provider\Domain\Service\BrandService\UpdateByBrand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByBrandSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    public function let(
        EntityTools $entityTools,
        ServiceRepository $serviceRepository
    ) {
        $this->entityTools = $entityTools;
        $this->serviceRepository = $serviceRepository;

        $this->beConstructedWith($entityTools, $serviceRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByBrand::class);
    }

    function it_does_nothing_if_not_new(
        BrandInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(false);

        $this
            ->serviceRepository
            ->findAll()
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_creates_brand_services(
        BrandInterface $entity,
        ServiceInterface $service,
        BrandServiceInterface $brandService
    ) {
        $entity
            ->isNew()
            ->willReturn(true);

        $entity
            ->getId()
            ->willReturn(1);

        $this
            ->serviceRepository
            ->findAll()
            ->willReturn([$service]);

        $this->getterProphecy(
            $service,
            [
                'getId' => 1,
                'getDefaultCode' => '94',
            ],
            false
        );

        $this
            ->entityTools
            ->persistDto(Argument::type(BrandServiceDto::class))
            ->willReturn($brandService)
            ->shouldBeCalled();

        $entity
            ->addService($brandService)
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
