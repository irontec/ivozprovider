<?php

namespace Tests\Provider\Company;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CompanyRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $this->assertInstanceOf(
            CompanyRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_by_brandId()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $companies = $repository->findByBrandId(1);

        $this->assertInternalType(
            'array',
            $companies
        );

        $this->assertInstanceOf(
            CompanyInterface::class,
            $companies[0]
        );
    }

    /**
     * @test
     */
    public function it_finds_prepaid_companies()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $companies = $repository->getPrepaidCompanies();

        $this->assertInternalType(
            'array',
            $companies
        );

        $this->assertInstanceOf(
            CompanyInterface::class,
            $companies[0]
        );
    }
}
