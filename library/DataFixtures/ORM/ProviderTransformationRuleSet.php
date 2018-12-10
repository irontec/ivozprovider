<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TransformationRuleSet::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item70 = $this->createEntityInstance(TransformationRuleSet::class);
        (function () {
            $this->setDescription("Generic transformation for Spain");
            $this->setGenerateRules(false);
            $this->setName(new Name('en', 'es'));
        })->call($item70);

        $item70->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTransformationRuleSet70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);

        $item253 = $this->createEntityInstance(TransformationRuleSet::class);
        (function () {
            $this->setDescription("");
            $this->setGenerateRules(false);
            $this->setName(new Name('en', 'es'));
        })->call($item253);

        $item253->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item253->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTransformationRuleSet253', $item253);
        $this->sanitizeEntityValues($item253);
        $manager->persist($item253);

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
