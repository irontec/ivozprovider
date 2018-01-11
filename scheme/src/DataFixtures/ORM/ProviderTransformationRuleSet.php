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
        $manager->getClassMetadata(TransformationRuleSet::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item70 = $this->createEntityInstanceWithPublicMethods(TransformationRuleSet::class);
        $item70->setDescription("Generic transformation for Spain");
        $item70->setGenerateRules(false);
        $item70->setName(new Name('en', 'es'));
        $item70->setCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet70', $item70);
        $manager->persist($item70);

        $item253 = $this->createEntityInstanceWithPublicMethods(TransformationRuleSet::class);
        $item253->setDescription("");
        $item253->setGenerateRules(false);
        $item253->setName(new Name('en', 'es'));
        $item253->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item253->setCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet253', $item253);
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
