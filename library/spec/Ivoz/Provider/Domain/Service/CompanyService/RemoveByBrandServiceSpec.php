<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Service\CompanyService\RemoveByBrandService;
use PhpSpec\ObjectBehavior;

class RemoveByBrandServiceSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var CompanyServiceRepository
     */
    protected $companyServiceRepository;

    /**
     * @var BrandServiceInterface
     */
    protected $entity;

    function let(
        EntityTools $entityTools,
        CompanyRepository $companyRepository,
        CompanyServiceRepository $companyServiceRepository,
        BrandServiceInterface $entity,
        BrandInterface $brand
    ) {
        $this->entityTools = $entityTools;
        $this->companyRepository = $companyRepository;
        $this->companyServiceRepository = $companyServiceRepository;
        $this->entity = $entity;

        $brand
            ->getId()
            ->willReturn(1);

        $this
            ->entity
            ->getBrand()
            ->willReturn($brand);

        $this->beConstructedWith(
            $this->entityTools,
            $this->companyRepository,
            $this->companyServiceRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveByBrandService::class);
    }

    function it_retrieves_every_company_of_this_brand()
    {
        $this
            ->companyRepository
            ->findByBrandId(1)
            ->willReturn([])
            ->shouldBeCalled();

        $this->execute($this->entity, false);
    }

    function it_removes_matching_company_services(
        CompanyInterface $company,
        ServiceInterface $service,
        CompanyServiceInterface $companyService
    ) {
        $company
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $this
            ->entity
            ->getService()
            ->willReturn($service)
            ->shouldBeCalled();

        $service
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $this
            ->companyRepository
            ->findByBrandId(1)
            ->willReturn([$company])
            ->shouldBeCalled();

        $this
            ->companyServiceRepository
            ->findCompanyService(
                1,
                1
            )
            ->willReturn($companyService);

        $this
            ->entityTools
            ->remove($companyService)
            ->shouldBeCalled();

        $this->execute(
            $this->entity
        );
    }
}
