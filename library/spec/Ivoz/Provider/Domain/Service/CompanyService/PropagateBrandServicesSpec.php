<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Service\CompanyService\PropagateBrandServices;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropagateBrandServicesSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

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
        EntityTools $entityTools,
        BrandServiceRepository $brandServiceRepository,
        BrandInterface $brand,
        CompanyInterface $company
    ) {
        $this->entityTools = $entityTools;
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
            $entityTools,
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

        $this
            ->company
            ->isNew()
            ->willReturn(false);

        $this->execute($this->company);
    }

    function it_searches_related_brand_services()
    {
        $this
            ->brandServiceRepository
            ->findByBrandId(1)
            ->willReturn([])
            ->shouldBeCalled();

        $this
            ->company
            ->isNew()
            ->willReturn(true);

        $this->execute($this->company);
    }

    function it_creates_company_services_by_brand_Services(
        BrandServiceInterface $brandService,
        CompanyServiceInterface $companyService,
        ServiceInterface $service
    ) {

        $this
            ->brandServiceRepository
            ->findByBrandId(1)
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
            ->entityTools
            ->persistDto(Argument::type(CompanyServiceDto::class))
            ->shouldBeCalled()
            ->willReturn($companyService);

        $this
            ->company
            ->getId()
            ->willReturn(3)
            ->shouldBeCalled();

        $this
            ->company
            ->addCompanyService(Argument::type(CompanyServiceInterface::class))
            ->shouldBeCalled();

        $this->entityTools
            ->dispatchQueuedOperations()
            ->shouldBeCalled();

        $this->entityTools
            ->persist($this->company)
            ->shouldBeCalled();

        $this
            ->company
            ->isNew()
            ->willReturn(true);

        $this->execute($this->company);
    }
}
