<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPattern\Name;
use Ivoz\Provider\Domain\Model\RoutingPattern\Description;

class ProviderRoutingPattern extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RoutingPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(RoutingPattern::class);
        (function () use ($fixture) {
            $this->setPrefix("+34");
            $this->setName(new Name('en', 'es', 'ca', 'it'));
            $this->setDescription(new Description('en', 'es', 'ca', 'it'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderRoutingPatternRoutingPattern68', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(RoutingPattern::class);
        (function () use ($fixture) {
            $this->setPrefix("+35");
            $this->setName(new Name('en', 'es', 'ca', 'it'));
            $this->setDescription(new Description('en', 'es', 'ca', 'it'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item2);

        $this->addReference('_reference_ProviderRoutingPatternRoutingPattern2', $item2);
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
