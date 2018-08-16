<?php
namespace Tests\Provider\Brand;

use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Ivoz\Provider\Domain\Model\Service\Service;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Domain\Domain;

class BrandLifeCycleTest extends KernelTestCase
{
    const COUNTRY_NUM = 3;
    const ZONE_NUM = 2;

    use DbIntegrationTestHelperTrait;

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
            ->setDefaultTimezoneId(1);

        /** @var Brand $brand */
        $brand = $this->entityTools
            ->persistDto($brandDto, null, true);

        return $brand;
    }

    /**
     * @test
     */
    public function it_persists_brands()
    {
        $brandRepository = $this->em
            ->getRepository(Brand::class);
        $fixtureBrands = $brandRepository->findAll();
        $this->assertCount(2, $fixtureBrands);

        $this->addBrand();

        $brands = $brandRepository->findAll();
        $this->assertCount(3, $brands);
    }

    /**
     * @test
     */
    public function added_brand_has_domain()
    {
        $this->addBrand();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            \Ivoz\Provider\Domain\Model\Domain\Domain::class
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

    /**
     * @test
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
     * @test
     */
    public function new_brand_autogenerates_routingPatterns_by_country()
    {
        $brand = $this->addBrand();

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

    /**
     * @test
     */
    public function new_brand_autogenerates_routingPatternGroups_by_country_zone()
    {
        $brand = $this->addBrand();

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

    /**
     * @test
     */
    public function new_brand_autogenerates_brandServices()
    {
        $serviceRepository = $this->em->getRepository(Service::class);
        $services = $serviceRepository->findAll();

        $brand = $this->addBrand();
        $brandServices = $brand->getServices();

        $this->assertCount(
            count($services),
            $brandServices
        );
    }
}