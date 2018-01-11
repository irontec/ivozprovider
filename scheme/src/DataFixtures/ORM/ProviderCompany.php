<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Company\Company;

class ProviderCompany extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Company::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Company::class);
        $item1->setName("DemoCompany");
        $item1->setDomainUsers("127.0.0.1");
        $item1->setNif("12345678A");
        $item1->setExternalMaxCalls(0);
        $item1->setPostalAddress("Company Address");
        $item1->setPostalCode("54321");
        $item1->setTown("Company Town");
        $item1->setProvince("Company Province");
        $item1->setCountryName("Company Country");
        $item1->setIpfilter(false);
        $item1->setOnDemandRecord(0);
        $item1->setOnDemandRecordCode("");
        $item1->setExternallyextraopts("");
        $item1->setRecordingsLimitEmail("");
        $item1->setLanguage($this->getReference('_reference_IvozProviderDomainModelLanguageLanguage1'));
        $item1->setMediaRelaySets($this->getReference('_reference_IvozProviderDomainModelMediaRelaySetMediaRelaySet0'));
        $item1->setDefaultTimezone($this->getReference('_reference_IvozProviderDomainModelTimezoneTimezone145'));
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item1->setDomain($this->getReference('_reference_IvozProviderDomainModelDomainDomain3'));
        $item1->setCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $item1->setTransformationRuleSet($this->getReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet70'));
        $this->addReference('_reference_IvozProviderDomainModelCompanyCompany1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Company::class);
        $item2->setName("Irontec Test Company");
        $item2->setDomainUsers("test.irontec.com");
        $item2->setNif("12345678-Z");
        $item2->setExternalMaxCalls(0);
        $item2->setPostalAddress("Postal address");
        $item2->setPostalCode("PC");
        $item2->setTown("Town");
        $item2->setProvince("Province");
        $item2->setCountryName("Country");
        $item2->setIpfilter(true);
        $item2->setOnDemandRecord(0);
        $item2->setOnDemandRecordCode("");
        $item2->setLanguage($this->getReference('_reference_IvozProviderDomainModelLanguageLanguage1'));
        $item2->setMediaRelaySets($this->getReference('_reference_IvozProviderDomainModelMediaRelaySetMediaRelaySet0'));
        $item2->setDefaultTimezone($this->getReference('_reference_IvozProviderDomainModelTimezoneTimezone145'));
        $item2->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item2->setDomain($this->getReference('_reference_IvozProviderDomainModelDomainDomain5'));
        $item2->setCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $item2->setTransformationRuleSet($this->getReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet70'));
        $this->addReference('_reference_IvozProviderDomainModelCompanyCompany2', $item2);
        $manager->persist($item2);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderLanguage::class,
            ProviderMediaRelaySet::class,
            ProviderTimezone::class,
            ProviderBrand::class,
            ProviderDomain::class,
            ProviderCountry::class,
            ProviderTransformationRuleSet::class
        );
    }
}
