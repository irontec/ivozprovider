<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(IvrEntry::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(IvrEntry::class);
        (function () use ($fixture) {
            $this->setEntry("test");
            $this->setRouteType("number");
            $this->setNumberValue("946002050");
            $this->setIvr($fixture->getReference('_reference_ProviderIvr1'));
            $this->setWelcomeLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

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
