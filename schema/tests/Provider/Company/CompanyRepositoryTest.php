<?php

namespace Tests\Provider\Company;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class CompanyRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_find_ids_by_brandId();
        $this->it_find_domain_ids_by_brandId();
        $this->it_finds_prepaid_companies();
        $this->it_finds_vpbx_company_ids_by_brand();
        $this->it_finds_one_by_domain();
        $this->it_finds_by_corporation_id();
        $this->it_finds_companyIds_by_admin_corporation();
        $this->it_counts_companies();
        $this->it_counts_companies_by_brand();
        $this->it_finds_latest_companies();
    }

    public function it_finds_one_by_domain()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $company = $repository->findOneByDomain('test.irontec.com');

        $this->assertInstanceOf(
            Company::class,
            $company
        );
    }

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

    public function it_find_ids_by_brandId()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $companies = $repository->findIdsByBrandId(1);

        $this->assertIsArray(
            $companies
        );

        $this->assertIsInt(
            $companies[0]
        );
    }

    public function it_find_domain_ids_by_brandId()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $domains = $repository->findDomainIdsByBrandId(1);

        $this->assertIsArray(
            $domains
        );

        $this->assertIsInt(
            $domains[0]
        );
    }

    public function it_finds_prepaid_companies()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $companies = $repository->getPrepaidCompanies();

        $this->assertIsArray(
            $companies
        );

        $this->assertInstanceOf(
            CompanyInterface::class,
            $companies[0]
        );
    }

    public function it_finds_vpbx_company_ids_by_brand()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $ids = $repository->getVpbxIdsByBrand(1);

        $this->assertIsArray(
            $ids
        );

        $this->assertIsInt(
            $ids[0]
        );
    }

    public function it_finds_by_corporation_id()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $companies = $repository->findByCorporationId(1);

        $this->assertIsArray(
            $companies
        );

        $this->assertInstanceOf(
            CompanyInterface::class,
            $companies[0]
        );
    }

    public function it_finds_companyIds_by_admin_corporation()
    {
        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this
            ->em
            ->getRepository(Company::class);

        /** @var AdministratorRepository $adminRepository */
        $adminRepository = $this->em->getRepository(Administrator::class);

        $admin = $adminRepository->findClientAdminByUsername('test_company_admin');
        $companyIds = $companyRepository->getCompanyIdsByAdminCorporation($admin);

        $this->assertIsArray(
            $companyIds
        );

        $this->assertEquals(
            1,
            $companyIds[0]
        );
    }

    public function it_counts_companies()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $count = $repository->count([]);

        $this->assertEquals(
            5,
            $count
        );
    }

    public function it_counts_companies_by_brand()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $count = $repository->countByBrand(1);

        $this->assertEquals(
            4,
            $count
        );
    }

    public function it_finds_latest_companies()
    {
        /** @var CompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $clients = $repository->getLatestByBrandId(1);

        $this->assertInstanceOf(
            Company::class,
            $clients[0]
        );
    }

    public function it_finds_by_application_server()
    {
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $clients = $repository->findByApplicationServerId(1);

        $this->assertInstanceOf(
            Company::class,
            $clients[0]
        );

        $this->assertEquals(
            1,
            $clients
        );
    }
}
