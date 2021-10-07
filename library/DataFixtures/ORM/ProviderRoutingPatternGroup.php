<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;

class ProviderRoutingPatternGroup extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RoutingPatternGroup::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item7 = $this->createEntityInstance(RoutingPatternGroup::class);
        (function () use ($fixture) {
            $this->setName("Europe");
            $this->setDescription("");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item7);

        $this->addReference('_reference_ProviderRoutingPatternGroup7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

        $item21 = $this->createEntityInstance(RoutingPatternGroup::class);
        (function () use ($fixture) {
            $this->setName("Empty");
            $this->setDescription("Empty");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item21);

        $this->addReference('_reference_ProviderRoutingPatternGroup21', $item21);
        $this->sanitizeEntityValues($item21);
        $manager->persist($item21);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
