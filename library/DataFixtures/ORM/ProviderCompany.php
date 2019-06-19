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
        $item1 = $this->createEntityInstance(Company::class);
        (function () {
            $this->setName("DemoCompany");
            $this->setDomainUsers("127.0.0.1");
            $this->setNif("12345678A");
            $this->setMaxCalls(0);
            $this->setPostalAddress("Company Address");
            $this->setPostalCode("54321");
            $this->setTown("Company Town");
            $this->setProvince("Company Province");
            $this->setCountryName("Company Country");
            $this->setIpfilter(false);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
            $this->setExternallyextraopts("");
            $this->setRecordingsLimitEmail("");
            $this->setBillingMethod("prepaid");
            $this->setBalance(1.2);
        })->call($item1);

        $item1->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item1->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySet'));
        $item1->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setDomain($this->getReference('_reference_ProviderDomain3'));
        $item1->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item1->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item1->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Company::class);
        (function () {
            $this->setName("Irontec Test Company");
            $this->setDomainUsers("test.irontec.com");
            $this->setNif("12345678-Z");
            $this->setMaxCalls(0);
            $this->setPostalAddress("Postal address");
            $this->setPostalCode("PC");
            $this->setTown("Town");
            $this->setProvince("Province");
            $this->setCountryName("Country");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
        })->call($item2);

        $item2->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item2->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySet'));
        $item2->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setDomain($this->getReference('_reference_ProviderDomain5'));
        $item2->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item2->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item2->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Company::class);
        (function () {
            $this->setName("Retail Company");
            $this->setType("retail");
            $this->setDomainUsers("retail.irontec.com");
            $this->setNif("12345679-Z");
            $this->setMaxCalls(0);
            $this->setPostalAddress("");
            $this->setPostalCode("");
            $this->setTown("");
            $this->setProvince("");
            $this->setCountryName("");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
        })->call($item3);

        $item3->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item3->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySet'));
        $item3->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item3->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item3->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item3->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item3->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);


        $item4 = $this->createEntityInstance(Company::class);
        (function () {
            $this->setName("Retail Company 2");
            $this->setType("retail");
            $this->setDomainUsers("retail2.irontec.com");
            $this->setNif("12345679-Z");
            $this->setMaxCalls(0);
            $this->setPostalAddress("");
            $this->setPostalCode("");
            $this->setTown("");
            $this->setProvince("");
            $this->setCountryName("");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
        })->call($item4);

        $item4->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item4->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySet'));
        $item4->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item4->setBrand($this->getReference('_reference_ProviderBrand2'));
        $item4->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item4->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item4->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        $item5 = $this->createEntityInstance(Company::class);
        (function () {
            $this->setName("Wholesale Company");
            $this->setType("wholesale");
            $this->setDomainUsers("wholesale.irontec.com");
            $this->setNif("12345689-Z");
            $this->setMaxCalls(0);
            $this->setPostalAddress("");
            $this->setPostalCode("");
            $this->setTown("");
            $this->setProvince("");
            $this->setCountryName("");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
        })->call($item5);

        $item5->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item5->setMediaRelaySets($this->getReference('_reference_ProviderMediaRelaySet'));
        $item5->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $item5->setBrand($this->getReference('_reference_ProviderBrand2'));
        $item5->setCountry($this->getReference('_reference_ProviderCountry70'));
        $item5->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item5->setVoicemailNotificationTemplate($this->getReference('_reference_ProviderNotificationTemplate1'));
        $this->addReference('_reference_ProviderCompany5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

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
