<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $manager->getClassMetadata(RoutingPatternGroup::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item7 = $this->createEntityInstanceWithPublicMethods(RoutingPatternGroup::class);
        $item7->setName("Europe");
        $item7->setDescription("");
        $item7->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelRoutingPatternGroupRoutingPatternGroup7', $item7);
        $manager->persist($item7);

        $item21 = $this->createEntityInstanceWithPublicMethods(RoutingPatternGroup::class);
        $item21->setName("Empty");
        $item21->setDescription("Empty");
        $item21->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelRoutingPatternGroupRoutingPatternGroup21', $item21);
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
