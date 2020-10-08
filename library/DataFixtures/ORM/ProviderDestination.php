<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Destination\Destination;
use Ivoz\Provider\Domain\Model\Destination\Name;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;

class ProviderDestination extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Destination::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DestinationInterface $item1 */
        $item1 = $this->createEntityInstance(Destination::class);
        (function () use ($fixture) {
            $this->setPrefix("+94600");
            $this->setName(new Name('Bilbao', 'Bilbao', 'Bilbao', 'Bilbao'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderDestination1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var DestinationInterface $item1 */
        $item2 = $this->createEntityInstance(Destination::class);
        (function () use ($fixture) {
            $this->setPrefix("+94601");
            $this->setName(new Name('Usansolocity', 'Usansolocity', 'Usansolocity', 'Usansolocity'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item2);

        $this->addReference('_reference_ProviderDestination2', $item2);

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
