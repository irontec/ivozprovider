<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Service\CompanyService\RemoveByBrandService;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class RemoveByBrandServiceSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $companyRepository;
    protected $companyServiceRepository;
    protected $brandService;

    function let(
        EntityTools $entityTools,
        CompanyRepository $companyRepository,
        CompanyServiceRepository $companyServiceRepository,
        BrandServiceInterface $brandService,
        BrandInterface $brand
    ) {
        $this->entityTools = $entityTools;
        $this->companyRepository = $companyRepository;
        $this->companyServiceRepository = $companyServiceRepository;
        $this->brandService = $brandService;

        $this->beConstructedWith(
            $this->entityTools,
            $this->companyRepository,
            $this->companyServiceRepository
        );
    }

    protected function prepareExecution()
    {
        $brand = $this->getInstance(
            Brand::class,
            [
                'id' => 1
            ]
        );

        $this
            ->brandService
            ->getBrand()
            ->willReturn($brand);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveByBrandService::class);
    }

    function it_retrieves_every_company_of_this_brand()
    {
        $this->prepareExecution();

        $this
            ->companyRepository
            ->findIdsByBrandId(1)
            ->willReturn([])
            ->shouldBeCalled();

        $this->execute($this->brandService);
    }

    function it_removes_matching_company_services()
    {
        $this->prepareExecution();

        $companyId = 10;
        $company = $this->getInstance(
            Company::class,
            [
                'id' => $companyId
            ]
        );

        $serviceId = 11;
        $service = $this->getInstance(
            Service::class,
            [
                'id' => $serviceId
            ]
        );

        $companyService = $this->getInstance(
            CompanyService::class,
            []
        );

        $this
            ->brandService
            ->getService()
            ->willReturn($service)
            ->shouldBeCalled();

        $this
            ->companyRepository
            ->findIdsByBrandId(1)
            ->willReturn([$companyId])
            ->shouldBeCalled();

        $this
            ->companyServiceRepository
            ->findCompanyService(
                $companyId,
                $serviceId
            )
            ->willReturn($companyService)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->remove($companyService)
            ->shouldBeCalled();

        $this->execute(
            $this->brandService
        );
    }
}
