<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\Name;

class ProviderTransformationRuleSet extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TransformationRuleSet::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item70 = $this->createEntityInstance(TransformationRuleSet::class);
        (function () use ($fixture) {
            $this->setDescription("Brand 1 transformation for Spain");
            $this->setGenerateRules(false);
            $this->setInternationalCode('00');
            $this->name = new Name(
                'Brand 1 transformation for Spain',
                'Marca 1 tansformacion para España',
                'Marca 1 tansformacion para España',
                'Brand 1 transformation for Spain',
            );
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item70);

        $this->addReference('_reference_ProviderTransformationRuleSet70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);

        $item253 = $this->createEntityInstance(TransformationRuleSet::class);
        (function () use ($fixture) {
            $this->setDescription("Brand 2 transformation for Spain");
            $this->setGenerateRules(false);
            $this->setInternationalCode('00');
            $this->name = new Name(
                'Brand 2 transformation for Spain',
                'Marca 2 tansformacion para España',
                'Marca 2 tansformacion para España',
                'Brand 2 transformation for Spain',
            );
            $this->setBrand($fixture->getReference('_reference_ProviderBrand2'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item253);

        $this->addReference('_reference_ProviderTransformationRuleSet253', $item253);
        $this->sanitizeEntityValues($item253);
        $manager->persist($item253);

        $item3 = $this->createEntityInstance(TransformationRuleSet::class);
        (function () use ($fixture) {
            $this->setDescription("Generic transformation for Spain");
            $this->setGenerateRules(false);
            $this->setInternationalCode('00');
            $this->name = new Name(
                'Generic transformation for Spain',
                'Generic tansformacion para España',
                'Generic tansformacion para España',
                'Generic transformation for Spain',
            );
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item3);

        $this->addReference('_reference_ProviderTransformationRuleSet120', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCountry::class
        );
    }
}
