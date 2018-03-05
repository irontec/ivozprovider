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
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Administrator::class);
        $item1->setUsername("admin");
        $item1->setPass('changeme');
        $item1->setEmail("admin@example.com");
        $item1->setActive(true);
        $item1->setName("admin");
        $item1->setLastname("ivozprovider");
        $item1->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Administrator::class);
        $item2->setUsername("test admin");
        $item2->setPass("changeme");
        $item2->setEmail("nightwatch@irontec.com");
        $item2->setActive(true);
        $item2->setName("night");
        $item2->setLastname("watch");
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Administrator::class);
        $item3->setUsername("irontec");
        $item3->setPass("changeme");
        $item3->setEmail("vozip@irontec.com");
        $item3->setActive(true);
        $item3->setName("irontec");
        $item3->setLastname("ivozprovider");
        $item3->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(Administrator::class);
        $item4->setUsername("test_company_admin");
        $item4->setPass("changeme");
        $item4->setEmail("test@irontec.com");
        $item4->setActive(true);
        $item4->setName("Admin Name");
        $item4->setLastname("Admin Lastname");
        $item4->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item4->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item4->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderAdministrator4', $item4);
        $manager->persist($item4);

    
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
