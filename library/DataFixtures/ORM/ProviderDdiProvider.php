<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

class ProviderDdiProvider extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(DdiProvider::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(DdiProvider::class);
        (function () use ($fixture) {
            $this->setName("DDIProviderName");
            $this->setDescription("DDIProviderDescription");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
        })->call($item1);

        $this->addReference('_reference_ProviderDdiProvider1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderTransformationRuleSet::class
        );
    }
}
