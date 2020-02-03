<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;

class ProviderExternalCallFilterRelSchedule extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilterRelSchedule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ExternalCallFilterRelSchedule $item1 */
        $item1 = $this->createEntityInstance(ExternalCallFilterRelSchedule::class);
        (function () use ($fixture) {
            $this->setFilter(
                $fixture->getReference('_reference_ProviderExternalCallFilter1')
            );
            $this->setSchedule(
                $fixture->getReference('_reference_ProviderSchedule1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderExternalCallFilterRelSchedule1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderExternalCallFilter::class,
            ProviderSchedule::class
        );
    }
}
