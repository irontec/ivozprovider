<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilterRelCalendar::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ExternalCallFilterRelCalendar $item1 */
        $item1 = $this->createEntityInstance(ExternalCallFilterRelCalendar::class);
        $item1->setFilter(
            $this->getReference('_reference_ProviderExternalCallFilter1')
        );
        $item1->setCalendar(
            $this->getReference('_reference_ProviderCalendar1')
        );
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
