<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContract;

class ProviderPeeringContract extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(PeeringContract::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(PeeringContract::class);
        $item1->setDescription("Artemis-Dev");
        $item1->setName("Artemis-Dev");
        $item1->setExternallyRated(false);
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item1->setTransformationRuleSet($this->getReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet70'));
        $this->addReference('_reference_IvozProviderDomainModelPeeringContractPeeringContract1', $item1);
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
