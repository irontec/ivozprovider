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
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_company_services();
        $this->it_finds_serviceIds_by_company();
    }

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

    public function it_finds_serviceIds_by_company()
    {
        /** @var CompanyServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CompanyService::class);

        $response = $repository->findServiceIdsByCompany(
            1
        );

        $this->assertIsArray(
            $response
        );

        $this->assertIsInt(
            $response[0]
        );
    }
}
