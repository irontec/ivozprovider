<?php

namespace Tests\Provider\Brand;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Core\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrand;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTag;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUser;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrand;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdr;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Cgr\Domain\Model\TpDerivedCharger\TpDerivedCharger;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;

class BrandLifeCycleTest extends KernelTestCase
{
    const COUNTRY_NUM = 249;
    const ZONE_NUM = 7;

    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_persists_brands()
    {
        $brandRepository = $this->em
            ->getRepository(Brand::class);
        $fixtureBrands = $brandRepository->findAll();
        $brand = $this->addBrand();

        $brands = $brandRepository->findAll();
        $this->assertCount(count($fixtureBrands) + 1, $brands);

        $this->it_triggers_lifecycle_services();
        $this->added_brand_has_domain();
        $this->new_brand_autogenerates_routingPatterns_by_country($brand);
        $this->new_brand_autogenerates_routingPatternGroups_by_country_zone($brand);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateBrand();
        $this->assetChangedEntities([
            Brand::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeBrand();
        $this->assetChangedEntities([
            WebPortal::class,
            MusicOnHold::class,
            FixedCostsRelInvoice::class,
            Invoice::class,
            Locution::class,
            Recording::class,
            FaxesInOut::class,
            Fax::class,
            FaxesRelUser::class,
            TpRatingProfile::class,
            RatingProfile::class,
            TpAccountAction::class,
            FeaturesRelCompany::class,
            Company::class,
            Domain::class,
            FeaturesRelBrand::class,
            Brand::class,
            ProxyTrunksRelBrand::class,
            CompanyRelRoutingTag::class,
            ApplicationServerSetsRelBrand::class,
            MediaRelaySetsRelBrand::class,
            DdiProvider::class,
            Carrier::class,
            UsersCdr::class,
            BillableCall::class,
        ]);
    }

    /**
     * @test
     * @deprecated
     */
    public function empty_domain_users_removes_domain()
    {
        $brandRepository = $this->em->getRepository(Brand::class);
        /** @var Brand $brand */
        $brand = $brandRepository->find(2);
        $domainId = $brand->getDomain()->getId();

        $this->assertEquals(
            $domainId,
            4
        );

        $brand->setDomainUsers('');
        $this->entityTools
            ->persist($brand, true);

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            Domain::class
        );

        $this->assertCount(1, $changelogEntries);
        $domainChangelog = $changelogEntries[0];

        $this->assertEquals(
            $domainChangelog->getEntityId(),
            $domainId
        );

        $this->assertEquals(
            $domainChangelog->getData(),
            null
        );
    }


    /**
     * @test
     * @deprecated
     */
    public function removing_brand_removes_its_domain()
    {
        /** @var Brand $brand */
        $brandRepository = $this->em->getRepository(Brand::class);
        $brand = $brandRepository->find(2);
        $domainId = $brand->getDomain()->getId();

        $this->entityTools->remove($brand);

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            Domain::class
        );

        $this->assertCount(1, $changelogEntries);
        $domainChangelog = $changelogEntries[0];

        $this->assertEquals(
            $domainChangelog->getEntityId(),
            $domainId
        );

        $this->assertEquals(
            $domainChangelog->getData(),
            null
        );
    }


    /**
     * @return Brand
     */
    protected function addBrand()
    {
        $brandDto = new BrandDto();
        $brandDto
            ->setName('Name')
            ->setDomainUsers('DomainUsers')
            ->setInvoiceNif('InvoiceNif')
            ->setInvoicePostalAddress('InvoicePostalAddress')
            ->setInvoicePostalCode('48960')
            ->setInvoiceTown('InvoiceTown')
            ->setInvoiceProvince('InvoiceProvince')
            ->setInvoiceCountry('InvoiceCountry')
            ->setDefaultTimezoneId(1)
            ->setLanguageId(1)
            ->setCurrencyId(1);

        $brandDto->setApplicationServerSets([0]);
        $brandDto->setMediaRelaySets([0]);

        /** @var Brand $brand */
        $brand = $this->entityTools
            ->persistDto($brandDto, null, true);

        return $brand;
    }

    protected function updateBrand()
    {
        $brandRepository = $this->em
            ->getRepository(Brand::class);

        $brand = $brandRepository->find(1);

        /** @var BrandDto $brandDto */
        $brandDto = $this->entityTools->entityToDto($brand);
        $brandDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($brandDto, $brand, true);
    }

    protected function removeBrand()
    {
        $brandRepository = $this->em
            ->getRepository(Brand::class);

        $brand = $brandRepository->find(1);

        $this
            ->entityTools
            ->remove($brand);
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            Brand::class,
            Domain::class,
            RoutingPattern::class,
            RoutingPatternGroup::class,
            BrandService::class,
            TpDerivedCharger::class,
            RoutingPatternGroupsRelPattern::class,
            Administrator::class,
            ApplicationServerSetsRelBrand::class,
            MediaRelaySetsRelBrand::class
        ]);
    }

    protected function added_brand_has_domain()
    {
        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            Domain::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'domain' => 'DomainUsers',
                'pointsTo' => 'proxyusers',
                'description' => 'Name proxyusers domain',
                'id' => 7
            ]
        );
    }

    protected function new_brand_autogenerates_routingPatterns_by_country(Brand $brand)
    {
        $countryRepository = $this->em->getRepository(Country::class);
        /** @var Country[] $countries */
        $countries = $countryRepository->findAll();
        $this->assertCount(
            self::COUNTRY_NUM,
            $countries
        );

        $routingPatternRepository = $this->em->getRepository(RoutingPattern::class);
        /** @var RoutingPattern[] $routingPatterns */
        $routingPatterns = $routingPatternRepository
            ->findBy(['brand' => $brand->getId()]);

        $this->assertCount(
            self::COUNTRY_NUM,
            $routingPatterns
        );

        $routingPatternIds = [];
        foreach ($routingPatterns as $routingPattern) {
            $routingPatternIds[] = $routingPattern->getid();
        }

        $routingPatternGroupsRelPatternRepository = $this->em->getRepository(RoutingPatternGroupsRelPattern::class);
        $routingPatternGroupsRelPatterns = $routingPatternGroupsRelPatternRepository->findAll();

        $routingPatternGroupsRelPatterns = array_filter(
            $routingPatternGroupsRelPatterns,
            function ($item) use ($routingPatternIds) {
                return in_array($item->getRoutingPattern()->getId(), $routingPatternIds);
            }
        );

        $this->assertCount(
            self::COUNTRY_NUM,
            $routingPatternGroupsRelPatterns
        );
    }

    protected function new_brand_autogenerates_routingPatternGroups_by_country_zone(Brand $brand)
    {
        $countryRepository = $this->em->getRepository(Country::class);
        /** @var Country[] $countries */
        $countries = $countryRepository->findAll();

        $zones = [];
        foreach ($countries as $country) {
            $zones[] = $country->getZone()->getEn();
        }
        $zones = array_unique($zones);

        $this->assertCount(
            self::ZONE_NUM,
            $zones
        );

        $routingPatternGroupRepository = $this->em->getRepository(RoutingPatternGroup::class);
        $routingPatternGroups = $routingPatternGroupRepository
            ->findBy(['brand' => $brand->getId()]);

        $this->assertCount(
            self::ZONE_NUM,
            $routingPatternGroups
        );
    }

    protected function new_brand_autogenerates_brandServices(Brand $brand)
    {
        $serviceRepository = $this->em->getRepository(Service::class);
        $services = $serviceRepository->findAll();

        $brandServices = $brand->getServices();

        $this->assertCount(
            count($services),
            $brandServices
        );
    }
}
