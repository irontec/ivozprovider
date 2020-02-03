<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
            $this->setName("Admin in UTC timezone");
            $this->setLastname("Admin Lastname");
            $this->setTimezone(null);
        })->call($item5);

        $this->addReference('_reference_ProviderAdministrator5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);


        $item6 = $this->createEntityInstance(Administrator::class);
        (function () use ($fixture) {
            $this->setUsername("utcBrandAdmin");
            $this->setPass("changeme");
            $this->setEmail("utc@irontec.com");
            $this->setActive(true);
            $this->setName("Brand Admin in UTC timezone");
            $this->setLastname("Lastname");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setTimezone(null);
        })->call($item6);

        $this->addReference('_reference_ProviderAdministrator6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

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
