<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;

class ProviderCalendar extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Calendar::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Calendar::class);
        (function () use ($fixture) {
            $this->setName("testCalendar");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);
        $this->addReference('_reference_ProviderCalendar1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Calendar::class);
        (function () use ($fixture) {
            $this->setName("testCalendar2");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item2);

        $this->addReference('_reference_ProviderCalendar2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
