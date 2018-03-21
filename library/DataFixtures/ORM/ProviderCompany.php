<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class ProviderCompany extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Company::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var CompanyInterface $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(Company::class);
        $item1->setName("DemoCompany");
        $item1->setDomainUsers("127.0.0.1");
        $item1->setNif("12345678A");
        $item1->setMaxCalls(0);
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
        $item1->setBillingMethod("prepaid");
        $item1->setBalance(1.2);
        $item1->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item1->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySetMediaRelaySet0'));
        $item1->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setDomain($this->getReference('_reference_ProviderDomain3'));
        $item1->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item1->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item1->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Company::class);
        $item2->setName("Irontec Test Company");
        $item2->setDomainUsers("test.irontec.com");
        $item2->setNif("12345678-Z");
        $item2->setMaxCalls(0);
        $item2->setPostalAddress("Postal address");
        $item2->setPostalCode("PC");
        $item2->setTown("Town");
        $item2->setProvince("Province");
        $item2->setCountryName("Country");
        $item2->setIpfilter(true);
        $item2->setOnDemandRecord(0);
        $item2->setOnDemandRecordCode("");
        $item2->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item2->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySetMediaRelaySet0'));
        $item2->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setDomain($this->getReference('_reference_ProviderDomain5'));
        $item2->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item2->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item2->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Company::class);
        $item3->setName("Retail Company");
        $item3->setType("retail");
        $item3->setDomainUsers("retail.irontec.com");
        $item3->setNif("12345679-Z");
        $item3->setMaxCalls(0);
        $item3->setPostalAddress("");
        $item3->setPostalCode("");
        $item3->setTown("");
        $item3->setProvince("");
        $item3->setCountryName("");
        $item3->setIpfilter(true);
        $item3->setOnDemandRecord(0);
        $item3->setOnDemandRecordCode("");
        $item3->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item3->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySetMediaRelaySet0'));
        $item3->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item3->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item3->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item3->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item3->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

    
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
            ProviderTransformationRuleSet::class,
            ProviderNotificationTemplate::class
        );
    }
}
