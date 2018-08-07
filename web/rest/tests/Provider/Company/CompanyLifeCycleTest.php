<?php

namespace Tests\Provider\Company;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Service\Service;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class CompanyLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return Company
     */
    protected function addCompany()
    {
        $companyDto = new CompanyDto();
        $companyDto
            ->setName('ACompany')
            ->setDomainUsers('127.3.0.1')
            ->setNif('12345678B')
            ->setMaxCalls(0)
            ->setPostalAddress('An address')
            ->setPostalCode('54321')
            ->setTown('')
            ->setProvince('')
            ->setCountryName('')
            ->setIpfilter(false)
            ->setOnDemandRecord(0)
            ->setOnDemandRecordCode('')
            ->setExternallyextraopts('')
            ->setRecordingsLimitEmail('')
            ->setLanguageId(1)
            ->setMediaRelaySetsId(0)
            ->setDefaultTimezoneId(1)
            ->setBrandId(1)
            ->setDomainId(1)
            ->setCountryId(1);

        /** @var Company $as */
        $company = $this->entityTools
            ->persistDto($companyDto, null, true);

        return $company;
    }

    /**
     * @test
     */
    public function it_persists_companies()
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);

        $fixtureCompanies = $companyRepository->findAll();
        $this->assertCount(3, $fixtureCompanies);

        $this->addCompany();

        $companies = $companyRepository->findAll();
        $this->assertCount(4, $companies);
    }

    /**
     * @test
     */
    public function added_company_has_default_mediaRelaySetsId()
    {
        $companyDto = new CompanyDto();
        $companyDto
            ->setName('ACompany')
            ->setDomainUsers('127.3.0.1')
            ->setNif('12345678B')
            ->setMaxCalls(0)
            ->setPostalAddress('An address')
            ->setPostalCode('54321')
            ->setTown('')
            ->setProvince('')
            ->setCountryName('')
            ->setIpfilter(false)
            ->setOnDemandRecord(0)
            ->setOnDemandRecordCode('')
            ->setExternallyextraopts('')
            ->setRecordingsLimitEmail('')
            ->setLanguageId(1)
            ->setMediaRelaySetsId(null)
            ->setDefaultTimezoneId(1)
            ->setBrandId(1)
            ->setDomainId(1)
            ->setCountryId(1);

        /** @var Company $as */
        $company = $this->entityTools
            ->persistDto($companyDto, null, true);

        $this->assertEquals(
            0,
            $company->getMediaRelaySets()->getId()
        );
    }

    /**
     * @test
     */
    public function added_company_has_a_domain()
    {
        $company = $this->addCompany();
        $domain = $company->getDomain();

        $this->assertInstanceOf(
            Domain::class,
            $domain
        );
    }

    /**
     * @test
     */
    public function updating_company_updates_domain()
    {
        $company = $this->addCompany();
        $domain = $company->getDomain();

        $this->assertEquals(
            $company->getDomainUsers(),
            $domain->getDomain()
        );

        $this->assertEquals(
            $company->getName() . ' proxyusers domain',
            $domain->getDescription()
        );

        $this->assertInstanceOf(
            Domain::class,
            $domain
        );

        $company
            ->setName('UpdatedName')
            ->setDomainUsers('UpdatedValue');
        $this->entityTools->persist($company, true);

        $this->assertEquals(
            'UpdatedValue',
            $domain->getDomain()
        );

        $this->assertEquals(
            'UpdatedName proxyusers domain',
            $domain->getDescription()
        );
    }

    /**
     * @test
     */
    public function added_company_has_a_tpAccountAction()
    {
        $company = $this->addCompany();
        $tpAccountActionRepository = $this->em
            ->getRepository(TpAccountAction::class);

        $tpAccountAction = $tpAccountActionRepository->findOneBy([
            'company' => $company->getId()
        ]);

        $this->assertInstanceOf(
            TpAccountAction::class,
            $tpAccountAction
        );
    }

    /**
     * @test
     */
    public function added_company_has_a_companyServices()
    {
        $company = $this->addCompany();
        $companyServices = $company->getCompanyServices();

        $brand = $company->getBrand();
        $brandServices = $brand->getServices();

        $this->assertEquals(
            count($brandServices),
            count($companyServices)
        );
    }

    /**
     * @test
     */
    public function removing_company_removes_domain()
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);
        $company = $companyRepository->find(1);
        $domain = $company->getDomain();
        $this->assertInstanceOf(
            Domain::class,
            $domain
        );

        $this->entityTools->remove($company);
        $this->assertNull($company->getDomain());
    }
}