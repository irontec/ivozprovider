<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;

class ProviderCarrier extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Carrier::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Carrier::class);
        (function () {
            $this->setDescription("CarrierDescription");
            $this->setName("CarrierName");
            $this->setExternallyRated(false);
        })->call($item1);

        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderCarrier1', $item1);
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
