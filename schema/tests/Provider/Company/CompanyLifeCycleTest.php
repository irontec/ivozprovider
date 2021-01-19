<?php

namespace Tests\Provider\Company;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Ivoz\Provider\Domain\Service\Company\SendUsersAddressPermissionsReloadRequest;
use Ivoz\Provider\Domain\Service\Company\SendUsersTrustedPermissionsReloadRequest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class CompanyLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_persists_companies()
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);
        $fixtureCompanies = $companyRepository->findAll();

        $company = $this->addCompany();

        $companies = $companyRepository->findAll();
        $this->assertCount(count($fixtureCompanies) + 1, $companies);

        ///////////////////
        ///
        ///////////////////

        $this->it_triggers_lifecycle_services();
        $this->added_company_has_a_domain($company);
        $this->added_company_has_a_tpAccountAction($company);
        $this->added_company_has_a_companyServices($company);
    }

    public function added_company_has_a_tpAccountAction(Company $company)
    {
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

    public function added_company_has_a_companyServices(Company $company)
    {
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
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateCompany();
        $this->assetChangedEntities([
            Company::class,
            Domain::class,
            PsEndpoint::class, // Domain lifecycle
            MaxUsageNotification::class
        ]);
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
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeCompany();
        $this->assetChangedEntities([
            /** orm_soft_delete start */
            Locution::class,
            MusicOnHold::class,
            Recording::class,
            FaxesInOut::class,
            Fax::class,
            TpRatingProfile::class,
            RatingProfile::class,
            TpAccountAction::class,
            FeaturesRelCompany::class,
            /** orm_soft_delete end */
            Company::class,
            Domain::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_user_address_permissions_reload_on_delete()
    {
        $this->mockInfraestructureServices(
            'provider.lifecycle.company.service_collection',
            ['on_commit' => [
                SendUsersAddressPermissionsReloadRequest::class
            ]],
            1
        );

        $repository = $this->em->getRepository(Company::class);
        $company = $repository->findOneBy([
            'name' => 'DemoCompany'
        ]);
        $this->entityTools->remove(
            $company
        );
    }

    /**
     * @test
     */
    public function it_triggers_trusted_reload_on_wholesale_companies_delete()
    {
        $trustedReloadServices = [
            'on_commit' => [SendUsersTrustedPermissionsReloadRequest::class]
        ];

        $this->mockInfraestructureServices(
            'provider.lifecycle.company.service_collection',
            $trustedReloadServices,
            1
        );

        $repository = $this->em->getRepository(Company::class);
        $company = $repository->findOneBy([
            'type' => 'wholesale'
        ]);
        $this->entityTools->remove(
            $company
        );

        $this->mockInfraestructureServices(
            'provider.lifecycle.company.service_collection',
            [
                'on_commit' => [SendUsersTrustedPermissionsReloadRequest::class]
            ],
            0
        );

        $repository = $this->em->getRepository(Company::class);
        $company = $repository->findOneBy([
            'type' => 'retail'
        ]);
        $this->entityTools->remove(
            $company
        );
    }

    //////////////////////////////////////////////////
    ///
    //////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
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
     * @deprecated
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

    protected function createDto()
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

        return $companyDto;
    }

    /**
     * @return Company
     */
    protected function addCompany()
    {
        $companyDto = $this->createDto();

        /** @var Company $company */
        $company = $this->entityTools
            ->persistDto($companyDto, null, true);

        return $company;
    }

    protected function updateCompany()
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);

        $company = $companyRepository->find(1);

        /** @var CompanyDto $companyDto */
        $companyDto = $this->entityTools->entityToDto($company);

        $companyDto
            ->setName('updatedName')
            ->setMaxDailyUsageEmail('no-replay@domain.net')
            ->setMaxDailyUsage(2)
            ->setCurrentDayUsage(3)
            ->setMaxDailyUsageNotificationTemplateId(3);

        return $this
            ->entityTools
            ->persistDto($companyDto, $company, true);
    }

    protected function removeCompany()
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);

        $company = $companyRepository->find(1);

        $this
            ->entityTools
            ->remove($company);
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            Domain::class,
            Company::class,
            TpAccountAction::class,
            CompanyService::class,
        ]);
    }

    protected function added_company_has_a_domain(Company $company)
    {
        $domain = $company->getDomain();

        $this->assertInstanceOf(
            Domain::class,
            $domain
        );
    }
}
