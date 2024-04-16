<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;

class ProviderAdministrator extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Administrator::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->getConnection()->exec(
            'INSERT INTO Administrators (id, username, pass, active) VALUES (0, "privateAdmin", "", 0)'
        );

        $item1 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("admin");
            $this->setPass('changeme');
            $this->setEmail("admin@example.com");
            $this->setActive(true);
            $this->setName("admin");
            $this->setLastname("ivozprovider");
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item1);

        $this->addReference('_reference_ProviderAdministrator1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("test_brand_admin");
            $this->setPass("changeme");
            $this->setEmail("nightwatch@irontec.com");
            $this->setActive(true);
            $this->setName("night");
            $this->setLastname("watch");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item2);

        $this->addReference('_reference_ProviderAdministrator2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("irontec");
            $this->setPass("changeme");
            $this->setEmail("vozip@irontec.com");
            $this->setActive(true);
            $this->setName("irontec");
            $this->setLastname("ivozprovider");
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item3);

        $this->addReference('_reference_ProviderAdministrator3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("test_company_admin");
            $this->setPass("changeme");
            $this->setEmail("test@irontec.com");
            $this->setActive(true);
            $this->setName("Admin Name");
            $this->setLastname("Admin Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item4);

        $this->addReference('_reference_ProviderAdministrator4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("utcAdmin");
            $this->setPass("changeme");
            $this->setEmail("utc@irontec.com");
            $this->setActive(true);
            $this->setRestricted(true);
            $this->setCanImpersonate(true);
            $this->setName("Admin in UTC timezone");
            $this->setLastname("Admin Lastname");
            $this->setTimezone(null);
        })->call($item5);

        $this->addReference('_reference_ProviderAdministrator5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("restrictedBrandAdmin");
            $this->setPass("changeme");
            $this->setEmail("restrictedAdmin@irontec.com");
            $this->setActive(true);
            $this->setRestricted(true);
            $this->setCanImpersonate(true);
            $this->setName("RestrictedAdmin");
            $this->setLastname("Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item6);

        $this->addReference('_reference_ProviderAdministrator6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $item7 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("restrictedCompanyAdmin");
            $this->setPass("changeme");
            $this->setEmail("test@irontec.com");
            $this->setActive(true);
            $this->setRestricted(true);
            $this->setName("Admin Name");
            $this->setLastname("Admin Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item7);

        $this->addReference('_reference_ProviderAdministrator7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

        $item8 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("test_residential_admin");
            $this->setPass("changeme");
            $this->setEmail("test@irontec.com");
            $this->setActive(true);
            $this->setName("Admin Name");
            $this->setLastname("Admin Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany4'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item8);
        $this->addReference('_reference_ProviderAdministrator8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);


        $item9 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("test_retail_admin");
            $this->setPass("changeme");
            $this->setEmail("test@irontec.com");
            $this->setActive(true);
            $this->setName("Admin Name");
            $this->setLastname("Admin Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany3'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item9);
        $this->addReference('_reference_ProviderAdministrator9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);

        $item10 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("__b1_internal");
            $this->setPass("[internal]");
            $this->setActive(false);
            $this->setRestricted(false);
            $this->setInternal(true);
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item10);
        $this->addReference('_reference_ProviderAdministrator10', $item10);
        $this->sanitizeEntityValues($item10);
        $manager->persist($item10);

        $item11 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("__c1_internal");
            $this->setPass("[internal]");
            $this->setActive(false);
            $this->setRestricted(false);
            $this->setInternal(true);
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item11);
        $this->addReference('_reference_ProviderAdministrator11', $item11);
        $this->sanitizeEntityValues($item11);
        $manager->persist($item11);

        $item12 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("test_wholesale_admin");
            $this->setPass("changeme");
            $this->setEmail("test@irontec.com");
            $this->setActive(true);
            $this->setName("Admin Name");
            $this->setLastname("Admin Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand2'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany5'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item12);
        $this->addReference('_reference_ProviderAdministrator12', $item12);
        $this->sanitizeEntityValues($item12);
        $manager->persist($item12);

        $item13 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("restrictedPlatformAdministrator");
            $this->setPass("changeme");
            $this->setEmail("utc@irontec.com");
            $this->setActive(true);
            $this->setRestricted(true);
            $this->setCanImpersonate(false);
            $this->setName("Admin in UTC timezone");
            $this->setLastname("Admin Lastname");
            $this->setTimezone(null);
        })->call($item13);

        $this->addReference('_reference_ProviderAdministrator13', $item13);
        $this->sanitizeEntityValues($item13);
        $manager->persist($item13);

        $item14 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("restrictedBrandOnlyAdmin");
            $this->setPass("changeme");
            $this->setEmail("restrictedAdmin@irontec.com");
            $this->setActive(true);
            $this->setRestricted(true);
            $this->setCanImpersonate(false);
            $this->setName("RestrictedAdmin");
            $this->setLastname("Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item14);

        $this->addReference('_reference_ProviderAdministrator14', $item14);
        $this->sanitizeEntityValues($item14);
        $manager->persist($item14);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class,
            ProviderTimezone::class
        );
    }
}
