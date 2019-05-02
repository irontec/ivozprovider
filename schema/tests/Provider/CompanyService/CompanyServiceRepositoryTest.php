<?php

namespace Tests\Provider\CompanyService;

use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;

class CompanyServiceRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CompanyServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CompanyService::class);

        $this->assertInstanceOf(
            CompanyServiceRepository::class,
            $repository
        );
    }

    public function it_finds_company_services()
    {
        /** @var CompanyServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CompanyService::class);

        $response = $repository->findCompanyService(
            1,
            1
        );

        $this->assertInstanceOf(
            CompanyServiceInterface::class,
            $response
        );
    }
}
