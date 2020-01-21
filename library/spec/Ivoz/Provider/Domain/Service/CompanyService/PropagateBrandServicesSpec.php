<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Service\CompanyService\PropagateBrandServices;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class PropagateBrandServicesSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $brandServiceRepository;

    protected $company;

    function let(
        EntityTools $entityTools,
        BrandServiceRepository $brandServiceRepository
    ) {
        $this->entityTools = $entityTools;
        $this->brandServiceRepository = $brandServiceRepository;

        $this->company = $this->getTestDouble(
            CompanyInterface::class,
            true
        );

        $this->beConstructedWith(
            $entityTools,
            $brandServiceRepository
        );

        $this->prepareExectution();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PropagateBrandServices::class);
    }

    protected function prepareExectution()
    {
        $brand = $this->getInstance(
            Brand::class,
            [
                'id' => 1
            ],
            false
        );

        $this->getterProphecy(
            $this->company,
            [
                'getBrand' => $brand,
                'isNew' => true,
                'getType' => CompanyInterface::TYPE_VPBX
            ],
            false
        );
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

        $this->execute(
            $this->company
        );
    }

    function it_returns_if_type_its_not_vpbx()
    {
        $this
            ->brandServiceRepository
            ->findBy(Argument::any())
            ->shouldNotBeCalled();

        $this
            ->company
            ->getType()
            ->willReturn(
                CompanyInterface::TYPE_RESIDENTIAL
            );

        $this->execute(
            $this->company
        );
    }

    function it_searches_related_brand_services()
    {
        $this
            ->brandServiceRepository
            ->findByBrandId(1)
            ->willReturn([])
            ->shouldBeCalled();

        $this->execute($this->company);
    }

    function it_creates_company_services_by_brand_Services()
    {
        $service = $this->getInstance(
            Service::class,
            [
                'id' => 1,
                'iden' => 'DirectPickUp'
            ]
        );

        $brandService = $this->getInstance(
            BrandService::class,
            [
                'service' => $service,
                'code' => 2
            ]
        );

        $companyService = $this->getInstance(
            CompanyService::class,
            [
                'service' => $service
            ]
        );

        $this
            ->brandServiceRepository
            ->findByBrandId(1)
            ->willReturn([$brandService])
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(Argument::type(CompanyServiceDto::class))
            ->shouldBeCalled()
            ->willReturn($companyService);

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

        $this->execute($this->company);
    }
}
