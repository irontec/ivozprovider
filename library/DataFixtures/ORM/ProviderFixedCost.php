<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCost;

class ProviderFixedCost extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FixedCost::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(FixedCost::class);
        (function () use ($fixture) {
            $this->setName("Monitoring");
            $this->setDescription("Something");
            $this->setCost("1.0000");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderFixedCost1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(FixedCost::class);
        (function () use ($fixture) {
            $this->setName("24x7");
            $this->setDescription("Something");
            $this->setCost("100.0000");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item2);

        $this->addReference('_reference_ProviderFixedCost2', $item2);
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
