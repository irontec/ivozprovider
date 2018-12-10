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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilterRelSchedule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ExternalCallFilterRelSchedule $item1 */
        $item1 = $this->createEntityInstance(ExternalCallFilterRelSchedule::class);
        $item1->setFilter(
            $this->getReference('_reference_ProviderExternalCallFilter1')
        );
        $item1->setSchedule(
            $this->getReference('_reference_ProviderSchedule1')
        );
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
