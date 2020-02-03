<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

class ProviderDestinationRate extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(DestinationRate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DestinationRateInterface $item1 */
        $item1 = $this->createEntityInstance(DestinationRate::class);

        (function () use ($fixture) {
            $this
                ->setCost('3.3')
                ->setConnectFee('0.01')
                ->setRateIncrement('1')
                ->setGroupIntervalStart('0');
            $this
                ->setDestination(
                    $fixture->getReference('_reference_ProviderDestination1')
                )
                ->setDestinationRateGroup(
                    $fixture->getReference('_reference_ProviderDestinationRateGroup1')
                );
        })->call($item1);

        $this->addReference('_reference_ProviderDestinationRate1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderDestination::class,
            ProviderDestinationRateGroup::class,
        );
    }
}
