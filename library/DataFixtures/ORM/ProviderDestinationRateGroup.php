<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\Name;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\Description;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class ProviderDestinationRateGroup extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(DestinationRateGroup::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DestinationRateGroupInterface $item1 */
        $item1 = $this->createEntityInstance(DestinationRateGroup::class);
        (function () use ($fixture) {
            $this->setStatus('inProgress');
            $this->setName(new Name('Standard', 'Standard', 'Standard', 'Standard'));
            $this->setDescription(new Description('', '', '', ''));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderDestinationRateGroup1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var DestinationRateGroupInterface $item2 */
        $item2 = $this->createEntityInstance(DestinationRateGroup::class);
        (function () use ($fixture) {
            $this->setStatus('inProgress');
            $this->setName(new Name('Fallback', 'Fallback', 'Fallback', 'Fallback'));
            $this->setDescription(new Description('', '', '', ''));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item2);

        $this->addReference('_reference_ProviderDestinationRateGroup2', $item2);

        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
