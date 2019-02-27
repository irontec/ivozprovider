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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Administrator::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->getConnection()->exec(
            'INSERT INTO Administrators (id, username, pass, active) VALUES (0, "privateAdmin", "", 0)'
        );

        $item1 = $this->createEntityInstance(Administrator::class);
        (function () {
            $this->setUsername("admin");
            $this->setPass('changeme');
            $this->setEmail("admin@example.com");
            $this->setActive(true);
            $this->setName("admin");
            $this->setLastname("ivozprovider");
        })->call($item1);

        $item1->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Administrator::class);
        (function () {
            $this->setUsername("test_brand_admin");
            $this->setPass("changeme");
            $this->setEmail("nightwatch@irontec.com");
            $this->setActive(true);
            $this->setName("night");
            $this->setLastname("watch");
        })->call($item2);

        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Administrator::class);
        (function () {
            $this->setUsername("irontec");
            $this->setPass("changeme");
            $this->setEmail("vozip@irontec.com");
            $this->setActive(true);
            $this->setName("irontec");
            $this->setLastname("ivozprovider");
        })->call($item3);

        $item3->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Administrator::class);
        (function () {
            $this->setUsername("test_company_admin");
            $this->setPass("changeme");
            $this->setEmail("test@irontec.com");
            $this->setActive(true);
            $this->setName("Admin Name");
            $this->setLastname("Admin Lastname");
        })->call($item4);

        $item4->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item4->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item4->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(Administrator::class);
        (function () {
            $this->setUsername("utcAdmin");
            $this->setPass("changeme");
            $this->setEmail("utc@irontec.com");
            $this->setActive(true);
            $this->setName("Admin in UTC timezone");
            $this->setLastname("Admin Lastname");
        })->call($item5);

        $item5->setTimezone(null);
        $this->addReference('_reference_ProviderAdministrator5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

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
