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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Company::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var CompanyInterface $item1 */
        $item1 = $this->createEntityInstance(Company::class);
        (function () use ($fixture) {
            $this->setName("DemoCompany");
            $this->setDomainUsers("127.0.0.1");
            $this->setNif("12345678A");
            $this->setMaxCalls(1000);
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
            $this->setMaxDailyUsageEmail('no-replay@domain.net');
            $this->setMaxDailyUsage(2);
            $this->setCurrentDayUsage(1);
            $this->setShowInvoices(true);
            $this->setMaxDailyUsageNotificationTemplate(
                $fixture->getReference('_reference_ProviderNotificationTemplate2')
            );
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
            $this->setMediaRelaySets($fixture->getReference('_reference_ProviderMediaRelaySet'));
            $this->setDefaultTimezone($fixture->getReference('_reference_ProviderTimezone145'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDomain($fixture->getReference('_reference_ProviderDomain3'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setVoicemailNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate1'));
        })->call($item1);

        $this->addReference('_reference_ProviderCompany1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Company::class);
        (function () use ($fixture) {
            $this->setName("Irontec Test Company");
            $this->setDomainUsers("test.irontec.com");
            $this->setNif("12345678-Z");
            $this->setMaxCalls(1000);
            $this->setPostalAddress("Postal address");
            $this->setPostalCode("PC");
            $this->setTown("Town");
            $this->setProvince("Province");
            $this->setCountryName("Country");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
            $this->setMediaRelaySets($fixture->getReference('_reference_ProviderMediaRelaySet'));
            $this->setDefaultTimezone($fixture->getReference('_reference_ProviderTimezone145'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDomain($fixture->getReference('_reference_ProviderDomain5'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setVoicemailNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate1'));
        })->call($item2);

        $this->addReference('_reference_ProviderCompany2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Company::class);
        (function () use ($fixture) {
            $this->setName("Retail Company");
            $this->setType("retail");
            $this->setDomainUsers(null);
            $this->setNif("12345679-Z");
            $this->setMaxCalls(1000);
            $this->setPostalAddress("");
            $this->setPostalCode("");
            $this->setTown("");
            $this->setProvince("");
            $this->setCountryName("");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
            $this->setShowInvoices(true);
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
            $this->setMediaRelaySets($fixture->getReference('_reference_ProviderMediaRelaySet'));
            $this->setDefaultTimezone($fixture->getReference('_reference_ProviderTimezone145'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setVoicemailNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate1'));
        })->call($item3);

        $this->addReference('_reference_ProviderCompany3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);


        $item4 = $this->createEntityInstance(Company::class);
        (function () use ($fixture) {
            $this->setName("Residential Company");
            $this->setType("residential");
            $this->setDomainUsers(null);
            $this->setNif("12345679-Z");
            $this->setMaxCalls(1000);
            $this->setPostalAddress("");
            $this->setPostalCode("");
            $this->setTown("");
            $this->setProvince("");
            $this->setCountryName("");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
            $this->setMediaRelaySets($fixture->getReference('_reference_ProviderMediaRelaySet'));
            $this->setDefaultTimezone($fixture->getReference('_reference_ProviderTimezone145'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setVoicemailNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate1'));
        })->call($item4);

        $this->addReference('_reference_ProviderCompany4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        $item5 = $this->createEntityInstance(Company::class);
        (function () use ($fixture) {
            $this->setName("Wholesale Company");
            $this->setType("wholesale");
            $this->setDomainUsers("wholesale.irontec.com");
            $this->setNif("12345689-Z");
            $this->setMaxCalls(1000);
            $this->setPostalAddress("");
            $this->setPostalCode("");
            $this->setTown("");
            $this->setProvince("");
            $this->setCountryName("");
            $this->setIpfilter(true);
            $this->setOnDemandRecord(0);
            $this->setOnDemandRecordCode("");
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
            $this->setMediaRelaySets($fixture->getReference('_reference_ProviderMediaRelaySet'));
            $this->setDefaultTimezone($fixture->getReference('_reference_ProviderTimezone145'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand2'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setVoicemailNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate1'));
        })->call($item5);

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
