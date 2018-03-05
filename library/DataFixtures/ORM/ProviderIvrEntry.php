<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntry;

class ProviderIvrEntry extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(IvrEntry::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(IvrEntry::class);
        $item1->setEntry("test");
        $item1->setRouteType("number");
        $item1->setNumberValue("946002050");
        $item1->setIvr($this->getReference('_reference_ProviderIvrIvr1'));
        $item1->setWelcomeLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderIvrEntry1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderIvr::class,
            ProviderLocution::class,
            ProviderCountry::class
        );
    }
}
