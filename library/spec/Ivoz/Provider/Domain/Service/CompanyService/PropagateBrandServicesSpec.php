<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Service\CompanyService\PropagateBrandServices;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropagateBrandServicesSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var BrandServiceRepository
     */
    protected $brandServiceRepository;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    function let(
        EntityPersisterInterface $entityPersister,
        BrandServiceRepository $brandServiceRepository,
        BrandInterface $brand,
        CompanyInterface $company
    ) {
        $this->entityPersister = $entityPersister;
        $this->brandServiceRepository = $brandServiceRepository;

        $brand
            ->getId()
            ->willReturn(1);

        $company
            ->getBrand()
            ->willReturn($brand);

        $this->brand = $brand;
        $this->company = $company;

        $this->beConstructedWith(
            $entityPersister,
            $brandServiceRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PropagateBrandServices::class);
    }

    function it_returns_on_not_new_entities()
    {
        $this
            ->brandServiceRepository
            ->findBy(Argument::any())
            ->shouldNotBeCalled();

        $this->execute(
            $this->company,
            false
        );
    }

    function it_searches_related_brand_services()
    {
        $this
            ->brandServiceRepository
            ->findBy(['brand' => 1])
            ->willReturn([])
            ->shouldBeCalled();

        $this->execute(
            $this->company,
            true
        );
    }

    function it_creates_company_services_by_brand_Services(
        BrandServiceInterface $brandService,
        ServiceInterface $service
    ) {

        $this
            ->brandServiceRepository
            ->findBy(['brand' => 1])
            ->willReturn([$brandService])
            ->shouldBeCalled();

        $brandService
            ->getService()
            ->willReturn($service)
            ->shouldBeCalled();

        $service
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $brandService
            ->getCode()
            ->willReturn(2)
            ->shouldBeCalled();

        $this
            ->company
            ->getId()
            ->willReturn(3)
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto(Argument::type(CompanyServiceDto::class))
            ->shouldBeCalled();

        $this->execute(
            $this->company,
            true
        );
    }
}
