<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar;

class ProviderExternalCallFilterRelCalendar extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilterRelCalendar::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ExternalCallFilterRelCalendar $item1 */
        $item1 = $this->createEntityInstance(ExternalCallFilterRelCalendar::class);
        (function () use ($fixture) {
            $this->setFilter(
                $fixture->getReference('_reference_ProviderExternalCallFilter1')
            );
            $this->setCalendar(
                $fixture->getReference('_reference_ProviderCalendar1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderExternalCallFilterRelCalendar1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderExternalCallFilter::class,
            ProviderCalendar::class
        );
    }
}
